<?php

namespace Tests\Unit\Http\Requests\Tag;

use App\Http\Requests\Tag\CreateRequest;
use Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\Factory;
use Tests\TestCase;

class CreateRequestTest extends TestCase
{
    use RefreshDatabase;

    protected Faker\Generator $faker;
    protected Factory $validationFactory;
    protected CreateRequest $formRequest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->validationFactory = $this->app['validator'];

        $this->formRequest = new CreateRequest();
    }

    /**
     * @group authorize
     */
    public function testAuthorizeShouldReturnTrue()
    {
        $this->assertTrue($this->formRequest->authorize());
    }

    /**
     * @return array
     */
    public function validationDataProvider(): array
    {
        return [
            'normal' => [
                'data' => [
                    'name' => $this->faker->unique()->name,
                ],
                'expected' => true,
            ],
            'abnormal::name:required' => [
                'data' => [],
                'expected' => false,
            ],
            'abnormal::name:min' => [
                'data' => [
                    'name' => str_repeat('a', 3),
                ],
                'expected' => false,
            ],
            'abnormal::name:max' => [
                'data' => [
                    'name' => str_repeat('a', 51),
                ],
                'expected' => false,
            ],
            'abnormal::name:unique' => [
                'data' => [
                    ['name' => 'testtag'],
                    ['name' => 'testtag'],
                ],
                'expected' => false,
            ],
        ];
    }

    /**
     * @param array $data
     * @param bool $expected
     *
     * @group validate
     * @dataProvider validationDataProvider
     */
    public function testValidate(array $data, bool $expected)
    {
        $validator = $this->validationFactory->make($data, $this->formRequest->rules());

        $actual = $validator->passes();

        $this->assertSame($actual, $expected);
    }
}
