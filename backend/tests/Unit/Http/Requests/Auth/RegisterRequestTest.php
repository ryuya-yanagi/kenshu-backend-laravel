<?php

namespace Tests\Unit\Http\Requests\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\Factory;
use Tests\TestCase;

class RegisterRequestTest extends TestCase
{
    use RefreshDatabase;

    protected Faker\Generator $faker;
    protected Factory $validationFactory;
    protected RegisterRequest $formRequest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Faker\Factory::create();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->validationFactory = $this->app['validator'];

        $this->formRequest = new RegisterRequest();
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
                    'password' => $this->faker->password()
                ],
                'expected' => true,
            ],
            'abnormal::name:required' => [
                'data' => [
                    'password' => $this->faker->password()
                ],
                'expected' => false,
            ],
            'abnormal::name:min' => [
                'data' => [
                    'name' => str_repeat('a', 3),
                    'password' => $this->faker->password()
                ],
                'expected' => false,
            ],
            'abnormal::name:max' => [
                'data' => [
                    'name' => str_repeat('a', 51),
                    'password' => $this->faker->password()
                ],
                'expected' => false,
            ],
            'abnormal::name:unique' => [
                'data' => [
                    ['name' => 'testuser', 'password' => $this->faker->password()],
                    ['name' => 'testuser', 'password' => $this->faker->password()],
                ],
                'expected' => false,
            ],
            'abnormal::password:required' => [
                'data' => [
                    'name' => $this->faker->sentence(2),
                ],
                'expected' => false,
            ],
            'abnormal::password:min' => [
                'data' => [
                    'name' => $this->faker->sentence(2),
                    'password' => str_repeat('a', 5)
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
