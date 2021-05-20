<?php

namespace Tests\Unit\Http\Requests\Article;

use App\Http\Requests\Article\CreateRequest;
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
                    'title' => $this->faker->sentence(2),
                    'body' => $this->faker->text(),
                ],
                'expected' => true,
            ],
            'abnormal::title:required' => [
                'data' => [
                    'body' => $this->faker->text()
                ],
                'expected' => false,
            ],
            'abnormal::title:min' => [
                'data' => [
                    'title' => str_repeat('a', 3),
                    'body' => $this->faker->text()
                ],
                'expected' => false,
            ],
            'abnormal::title:max' => [
                'data' => [
                    'title' => str_repeat('a', 51),
                    'body' => $this->faker->text()
                ],
                'expected' => false,
            ],
            'abnormal::body:required' => [
                'data' => [
                    'title' => $this->faker->sentence(2),
                ],
                'expected' => false,
            ],
            'abnormal::body:min' => [
                'data' => [
                    'title' => $this->faker->sentence(2),
                    'body' => 'a'
                ],
                'expected' => false,
            ],
            'abnormal::body:max' => [
                'data' => [
                    'title' => $this->faker->sentence(2),
                    'body' => str_repeat('a', 201),
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
