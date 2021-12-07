<?php

use \App\DataGenerator\FinancialTransactionsRu;

class FinancialTransactionsRuTest extends \PHPUnit\Framework\TestCase
{
	public function getValidateFailSamples(): array
	{
		return [
			'empty' => [
				[],
			],
			'filled but empty' => [
				[
					'Name' => '',
					'PersonalAcc' => '',
					'BankName' => '',
					'BIC' => '',
					'CorrespAcc' => '',
				],
			],
		];
	}

	public function getFailTypesSamples(): array
	{
		return [
			'null' => [null],
			'boolean' => [true],
			'array' => [[]],
			'object' => [new stdClass()],
		];
	}

	public function getValidateTypesSamples(): array
	{
		return [
			'int' => [123],
			'float' => [1.03],
			'string' => ["123"],
		];
	}

	public function getOverflowLengthFields(): array
	{
		return [
			'Name' => [self::fieldsNames[0], 160],
			'BANK_NAME' => [self::fieldsNames[1], 45],
			"FIELD_BIC" => [self::fieldsNames[2], 9],
			'Personal_Account' => [self::fieldsNames[3], 20],
			"CORRESPONDENT_ACCOUNT" => [self::fieldsNames[4], 20],
		];
	}

	public function getDataForTestGetData(): array
	{
		return [
			'emptyData' => [[], "ST00012"],
			'defaultData' => [
				self::defaultData,
				"ST00012|Name=Name|PersonalAcc=something|BankName=something|BIC=Nothing|CorrespAcc=something",
			],
			'dataWithNewFiled' => [
				self::dataWithNewField,
				"ST00012|Name=Name|PersonalAcc=something|BankName=something|BIC=Nothing|CorrespAcc=something|test=test",
			],
			'dataWithEmptyFiled' => [
				self::dataWithRemoveField,
				"ST00012|PersonalAcc=something|BankName=something|BIC=Nothing|CorrespAcc=something",
			],
		];
	}

	/**
	 * @dataProvider getValidateFailSamples
	 *
	 * @param array $fields
	 */
	public function testValidateFail(array $fields): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields($fields);

		$result = $dataGenerator->validate();

		static::assertFalse($result->isSuccess());
	}

	public function testThatValidateSuccess(): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields([]);

		$dataGenerator
			->setName('Name')
			->setBIC('BIC')
			->setBankName('BankName')
			->setCorrespondentAccount('CorrespondentAccount')
			->setPersonalAccount('CorrespondentAccount');

		$result = $dataGenerator->validate();

		static::assertTrue($result->isSuccess());
	}

	/**
	 * @dataProvider getFailTypesSamples
	 *
	 * @param $testFiled
	 */
	public function testCheckWrongTypesForFields($testFiled): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();
		$data = self::defaultData;

		foreach (self::fieldsNames as $fieldName)
		{
			$data[$fieldName] = $testFiled;
			$dataGenerator->setFields($data);
			$result = $dataGenerator->validate();
			static::assertFalse($result->isSuccess());
		}
	}

	/**
	 * @dataProvider getValidateTypesSamples()
	 *
	 * @param $testFiled
	 */
	public function testCheckValidateTypesForFields($testFiled): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();
		$data = self::defaultData;

		foreach (self::fieldsNames as $fieldName)
		{
			$data[$fieldName] = $testFiled;
			$dataGenerator->setFields($data);
			$result = $dataGenerator->validate();
			static::assertTrue($result->isSuccess());
		}
	}

	/**
	 * @dataProvider getOverflowLengthFields()
	 *
	 * @param string $fieldName
	 * @param int $maxFieldSize
	 */
	public function testOverflowMaximumLength(string $fieldName, int $maxFieldSize): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();
		$data = self::defaultData;

		$data[$fieldName] = str_repeat("#", $maxFieldSize + 1);
		$dataGenerator->setFields($data);

		$result = $dataGenerator->validate();
		static::assertFalse($result->isSuccess());
	}

	public function testChangeNumberOfFieldsToData(): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();
		$data = self::dataWithNewField;

		$dataGenerator->setFields($data);
		$result = $dataGenerator->validate();
		static::assertFalse($result->isSuccess());

		$data = self::dataWithRemoveField;
		$result = $dataGenerator->validate();
		static::assertFalse($result->isSuccess());
	}

	/**
	 * @dataProvider getDataForTestGetData()
	 *
	 * @param array $data
	 * @param string $expectedResult
	 */
	public function testGetData(array $data, string $expectedResult): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields($data);

		$data = $dataGenerator->getData();

		static::assertEquals($expectedResult, $data);
	}

	private const fieldsNames = [
		FinancialTransactionsRu::FIELD_NAME,
		FinancialTransactionsRu::FIELD_BANK_NAME,
		FinancialTransactionsRu::FIELD_BIC,
		FinancialTransactionsRu::FIELD_PERSONAL_ACCOUNT,
		FinancialTransactionsRu::FIELD_CORRESPONDENT_ACCOUNT,
	];

	private const defaultData = [
		'Name' => "Name",
		'PersonalAcc' => 'something',
		'BankName' => 'something',
		'BIC' => 'Nothing',
		'CorrespAcc' => 'something',
	];
	private const dataWithNewField=[
		'Name' => "Name",
		'PersonalAcc' => 'something',
		'BankName' => 'something',
		'BIC' => 'Nothing',
		'CorrespAcc' => 'something',
		'test'=>'test'
	];

	private const dataWithRemoveField=[
		'PersonalAcc' => 'something',
		'BankName' => 'something',
		'BIC' => 'Nothing',
		'CorrespAcc' => 'something',
	];
}
