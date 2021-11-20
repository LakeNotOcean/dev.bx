import { Item } from './item.js';

export class List
{
	isProgress;
	loading;
	itemListContainer;
	container;
	actionContainer;
	items;

	inputButtonHandler;
	defaultInputText = '';
	inputButtonTitle = 'add';
	currentItemIndex = -1;
	isCancelButton = false;

	constructor({ container })
	{
		this.container = container;
		this.actionContainer = {};
		this.items = [];

		this.itemListContainer = document.createElement('div');
		this.actionContainer = document.createElement('div');
		this.itemListContainer.classList.add('calendar-items');

		this.loading = document.createElement('div');
		this.loading.classList.add('hidden');
		this.loading.innerText = 'Loading...';

		this.inputButtonHandler = this.handleAddButtonClick;

		this.container.append(this.loading);

		this.container.append(this.itemListContainer);
		this.container.append(this.actionContainer);

		this.isProgress = false;
	}

	render()
	{
		this.load().then(({ items }) => {
			if (Array.isArray(items))
			{
				items.forEach((itemData) => {
					this.items.push(this.createItem(itemData));
				});
			}

			this.renderItems();
		}).catch((result) => {
			console.error('Error trying to load items: ' + result);
		});
		this.renderActions();
		this.container.append(this.actionContainer);
	}

	createItem(itemData)
	{
		itemData.deleteButtonHandler = this.handleDeleteButtonClick.bind(this);
		itemData.editButtonHandler = this.handleEditButtonClick.bind(this);

		return new Item(itemData);
	}

	handleDeleteButtonClick(item)
	{
		const index = this.items.indexOf(item);
		if (index > -1)
		{
			this.items.splice(index, 1);
			this.save().then(() => {
				this.renderItems();
			}).catch((error) => {
				console.error('Error trying to delete item',error);
			});
		}
	}

	handleEditButtonClick(item)
	{
		const index = this.items.indexOf(item);
		if (index > -1)
		{
			this.inputButtonTitle = 'save';
			this.defaultInputText = this.items[index]['title'];
			this.currentItemIndex = index;
			this.isCancelButton = true;

			this.inputButtonHandler = this.handleSaveChangesInputButtonClick;
			this.renderActions();
		}
	}

	handleSaveChangesInputButtonClick()
	{
		const resultString = this.container.querySelector('[class="calendar-new-item-title"]').value;

		if (this.items[this.currentItemIndex].title === resultString)
		{
			this.returnToAddButton();
			return;
		}
		if (resultString.length === 0)
		{
			this.items.splice(this.currentItemIndex, 1);
		}
		else
		{
			this.items[this.currentItemIndex].title = resultString;
		}
		this.returnToAddButton();

		this.save().then(() => {
			this.renderItems();
		}).catch((error) => {
			console.error('Error trying save items: ' + error);
		});
	}

	renderItems()
	{
		this.itemListContainer.innerHTML = '';

		this.items.forEach((item) => {
			this.itemListContainer.append(item.render());
		});
	}

	renderActions()
	{
		this.actionContainer.innerHTML = '';
		const addContainer = document.createElement('div');
		const addInput = document.createElement('input');
		addInput.classList.add('calendar-new-item-title');
		addInput.value = this.defaultInputText;
		const addButton = document.createElement('button');

		addButton.innerText = this.inputButtonTitle;
		addButton.addEventListener('click', this.inputButtonHandler.bind(this));

		addContainer.append(addInput);
		addContainer.append(addButton);
		if (this.isCancelButton)
		{
			const cancelButton = document.createElement('button');
			cancelButton.addEventListener('click', this.returnToAddButton.bind(this));
			cancelButton.innerText = 'cancel';
			addContainer.append(cancelButton);
		}

		this.actionContainer.append(addContainer);
	}

	handleAddButtonClick()
	{
		const addInput = this.container.querySelector('[class="calendar-new-item-title"]');
		if (addInput)
		{
			if (addInput.value.length === 0)
			{
				return;
			}
			this.items.push(this.createItem({ title: addInput.value }));
			addInput.value = '';

			this.save().then(() => {
				this.renderItems();
			}).catch((error) => {
				console.error('Error trying save items: ' + error);
			});
		}
	}

	load()
	{
		return new Promise((resolve, reject) => {
			if (this.isProgress)
			{
				reject('Another action in progress');
				return;
			}
			this.startProgress();
			return fetch(
				'/homework-8/ajax.php?action=load',
				{
					method: 'POST',
				},
			).then((response) => {
				return response.json();
			}).then((result) => {
				if (result.error)
				{
					reject(result.error);
					return;
				}

				resolve(result);
			}).catch((result) => {
				reject(result);
			}).finally(() => {
				this.stopProgress();
			});
		});
	}

	save()
	{
		return new Promise((resolve, reject) => {
			if (this.isProgress)
			{
				reject('Another action in progress');
				return;
			}
			this.startProgress();
			const data = {
				items: [],
			};
			this.items.forEach((item) => {
				data.items.push(item.getData());
			});

			return fetch(
				'/homework-8/ajax.php?action=save',
				{
					method: 'POST',
					headers: {
						'Content-Type': 'application/json;charset=utf-8',
					},
					body: JSON.stringify(data),
				},
			).then((response) => {
				return response.json();
			}).then((result) => {
				if (result.error)
				{
					reject(result.error);
					return;
				}

				resolve(result);
			}).catch((result) => {
				reject(result);
			}).finally(() => {
				this.stopProgress();
			});
		});
	}

	startProgress()
	{
		this.loading.classList.remove('hidden');
		this.isProgress = true;
	}

	stopProgress()
	{
		this.loading.classList.add('hidden');
		this.isProgress = false;
	}

	returnToAddButton()
	{
		this.defaultInputText = '';
		this.inputButtonTitle = 'add';
		this.isCancelButton = false;
		this.inputButtonHandler = this.handleAddButtonClick;
		this.renderActions();
		this.currentItemIndex = -1;
	}
}