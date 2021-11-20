export class Item
{
	title;
	deleteButtonHandler;
	editButtonHandler;

	constructor({ title, deleteButtonHandler,editButtonHandler })
	{
		this.title = String(title);
		if (typeof deleteButtonHandler === 'function')
		{
			this.deleteButtonHandler = deleteButtonHandler;
		}
		if (typeof editButtonHandler==='function')
		{
			this.editButtonHandler=editButtonHandler;
		}
	}

	getData()
	{
		return { title: this.title };
	}

	render()
	{
		const container = document.createElement('div');
		container.classList.add('item-container');
		const title = document.createElement('div');
		title.classList.add('item-title');
		title.innerText = this.title;
		container.append(title);

		const buttonsContainer = document.createElement('div');
		const deleteButton = document.createElement('button');
		const editButton = document.createElement('button');
		deleteButton.innerText = 'Delete';
		editButton.innerText = 'Edit';
		buttonsContainer.append(deleteButton);
		buttonsContainer.append(editButton);
		deleteButton.addEventListener('click', this.handleDeleteButtonClick.bind(this));
		editButton.addEventListener('click', this.handleEditButtonClick.bind(this));

		container.append(buttonsContainer);

		return container;
	}

	handleDeleteButtonClick()
	{
		console.log("delete button is clicked",this);
		if (this.deleteButtonHandler)
		{
			this.deleteButtonHandler(this);
		}
	}

	handleEditButtonClick()
	{
		if (this.editButtonHandler)
		{
			this.editButtonHandler(this);
		}
	}
}