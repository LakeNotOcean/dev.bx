<?php

use PHPUnit\Framework\TestCase;
use App\Order;
use App\Operation\Action;

class OperationTest extends TestCase
{
	protected const actionErrorMessage = 'action is failed';

	protected function getOrderThatSaves(bool $isSuccess = true): Order
	{
		$order = $this->getMockBuilder(\App\Order::class)
			->onlyMethods(['save'])
			->getMock();
		$result = new \App\Result();
		if (!$isSuccess)
		{
			$result->addError(new Error("save is not success"));
		}
		$order->expects(static::once())
			->method('save')
			->willReturn($result);

		return $order;
	}

	protected function getActionThatNeverInvoked(): Action
	{
		$action = $this->getMockBuilder(\App\Operation\Action::class)
			->onlyMethods(['process'])
			->getMockForAbstractClass();
		$action->expects(static::never())
			->method('process');

		return $action;
	}

	protected function getActionThatInvokedOnce(): Action
	{
		$action = $this->getMockBuilder(\App\Operation\Action::class)
			->onlyMethods(['process'])
			->getMockForAbstractClass();
		$action->expects(static::once())
			->method('process')
			->willReturn(new \App\Result());
		return $action;
	}

	protected function getActionThatFailed(): Action
	{
		$action = $this->getMockBuilder(\App\Operation\Action::class)
			->getMockForAbstractClass();

		$result = new \App\Result();
		$errorMessage = self::actionErrorMessage;
		$result->addError(new Error($errorMessage));

		$action->expects(static::once())
			->method('process')
			->willReturn($result);
		return $action;
	}

	public function testThatLaunchSuccessIfOrderSaveSuccess(): void
	{
		$order = $this->getOrderThatSaves();

		$operation = new App\Operation\Operation($order);

		$result = $operation->launch();

		static::assertTrue($result->isSuccess());
	}

	public function testThatLaunchFailIfOrderSaveFail(): void
	{
		$order = $this->getMockBuilder(\App\Order::class)
			->onlyMethods(['save'])
			->getMock();

		$errorCode = random_int(0, 999);

		$result = new \App\Result();
		$result->addError(new Error('Test message', $errorCode));

		$order->expects(static::once())
			->method('save')
			->willReturn($result);

		$operation = new App\Operation\Operation($order);

		$result = $operation->launch();

		static::assertFalse($result->isSuccess());

		$errorWithCode = null;
		foreach ($result->getErrors() as $error)
		{
			if ($error->getCode() === $errorCode)
			{
				$errorWithCode = $error;
			}
		}

		static::assertNotNull($errorWithCode);
	}

	public function testThatOrderSaveIsNotInvokedIfBeforeActionFail(): void
	{
		$order = $this->getMockBuilder(\App\Order::class)
			->onlyMethods(['save'])
			->getMock();

		$order->expects(static::never())
			->method('save');

		$operation = new App\Operation\Operation($order);

		$action = $this->getMockBuilder(\App\Operation\Action::class)
			->onlyMethods(['process'])
			->getMockForAbstractClass();
		$errorMessage = 'Error during before action in test';
		$action->expects(static::once())
			->method('process')
			->with($order)
			->willReturn((new \App\Result())->addError(new Error($errorMessage)));

		$operation->addAction(
			\App\Operation\Operation::ACTION_BEFORE_SAVE,
			$action
		);

		//		$action = new class extends \App\Operation\Action {
		//			public function process(\App\Order $order): \App\Result
		//			{
		//				return (new \App\Result())->addError(new Error('Test error'));
		//			}
		//		};

		$afterAction = $this->getActionThatNeverInvoked();

		$operation->addAction(
			\App\Operation\Operation::ACTION_AFTER_SAVE,
			$afterAction
		);

		$result = $operation->launch();

		static::assertFalse($result->isSuccess());
		static::assertEquals($errorMessage, $result->getErrorMessages()[0]);
	}

	public function testThatOperationConfigurationIsPossible(): void
	{
		$settings = new App\Operation\Settings();

		$order = $this->getOrderThatSaves();

		$operation = new App\Operation\Operation($order, $settings);

		$result = $operation->launch();

		static::assertNotNull($result);
	}

	public function testThatOperationHasSettingsObject(): void
	{
		$settings = new App\Operation\Settings();

		$order = $this->getMockBuilder(\App\Order::class)
			->onlyMethods(['save'])
			->getMock();

		$operation = new App\Operation\Operation($order, $settings);

		static::assertObjectHasAttribute('settings', $operation);
	}

	public function testThatOperationDoesNotInvokeBeforeActionsIfTheyDisabledInSettings(): void
	{
		$settings = new App\Operation\Settings();

		$settings->disableBeforeSaveActions();

		$order = $this->getOrderThatSaves();

		$operation = new App\Operation\Operation($order, $settings);
		$operation->addAction(
			App\Operation\Operation::ACTION_BEFORE_SAVE,
			$this->getActionThatNeverInvoked()
		);

		$operation->launch();
	}

	//Написанные учеником тесты
	public function testThatAfterActionNotInvokeIfDisableSetting(): void
	{
		$setting = new App\Operation\Settings();
		$setting->disableAfterSaveActions();
		$order = $this->getOrderThatSaves();
		$operation = new App\Operation\Operation($order, $setting);
		$operation->addAction(App\Operation\Operation::ACTION_AFTER_SAVE,
			$this->getActionThatNeverInvoked());

		$operation->launch();
	}

	public function testThatAfterActionInvokeIfNotDisableSetting(): void
	{
		$setting = new App\Operation\Settings();
		$order = $this->getOrderThatSaves();
		$operation = new App\Operation\Operation($order, $setting);
		$operation->addAction(App\Operation\Operation::ACTION_AFTER_SAVE,
			$this->getActionThatInvokedOnce());

		$operation->launch();
	}

	public function testThatAfterActionNotCheckedIfOrderFail(): void
	{
		$setting = $this->getMockBuilder(\App\Operation\Settings::class)
			->getMock();
		$setting->expects(static::never())->method("isAfterActionsEnabled");
		$order = $this->getOrderThatSaves(false);
		$operation = new App\Operation\Operation($order, $setting);
		$operation->launch();
	}

	public function testIfAfterActionFail(): void
	{
		$action = $this->getMockBuilder(\App\Operation\Action::class)
			->getMockForAbstractClass();

		$action = $this->getActionThatFailed();

		$order = $this->getOrderThatSaves();
		$operation = new App\Operation\Operation($order);
		$operation->addAction(App\Operation\Operation::ACTION_AFTER_SAVE, $action);
		$result = $operation->launch();

		static::assertEquals(self::actionErrorMessage, $result->getErrorMessages()[0]);
	}

	public function testThatAfterActionNotCheckedIfBeforeActionFail(): void
	{
		$setting = $this->getMockBuilder(\App\Operation\Settings::class)
			->getMock();
		$setting->expects(static::never())->method("isAfterActionsEnabled");
		$setting->expects(static::once())->method("isBeforeActionsEnabled")->willReturn(true);

		$action = $this->getActionThatFailed();

		$order = $this->getMockBuilder(\App\Order::class)->getMock();

		$operation = new App\Operation\Operation($order, $setting);
		$operation->addAction(App\Operation\Operation::ACTION_BEFORE_SAVE, $action);
		$operation->launch();
	}
}
