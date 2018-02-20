<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Avatar file.
     *
     * @var object
     */
    private $file;

    /**
     * User fixture.
     *
     * @var object
     */
    private $userFixture;

    /**
     * Setup.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->file = UploadedFile::fake()->image('avatar.jpg');
        $this->userFixture = resolve(\Tests\Fixtures\UserFixture::class);
    }

    /** @test */
    public function guest_can_not_create_a_user()
    {
        $this->post(route('users.store'))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_create_a_user()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->post(route('users.store'))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_visit_create_user_page()
    {
        $this->get(route('users.create'))
            ->assertRedirect('login');
    }

    /** @test */
    public function employee_can_not_visit_create_user_page()
    {
        $user = factory(User::class)->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('users.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_visit_create_user_page()
    {
        $user = factory(User::class)->states('admin')->create();

        $this->actingAs($user)
            ->get(route('users.create'))
            ->assertStatus(200)
            ->assertSee('Add Employee');
    }

    /** @test */
    public function admin_can_create_a_user()
    {
        $admin = factory(User::class)->states('admin')->create();

        Storage::fake('public');

        Image::shouldReceive('make->fit->save')->once();

        $input = $this->inputAttributes();
        $result = $this->resultAttributes();

        $this->actingAs($admin)
            ->post(route('users.store'), $input)
            ->assertSessionHas('status', 'The employee was successfully created!');

        $this->assertDatabaseHas('users', $result);

        Storage::disk('public')->assertExists('avatars/'.$this->file->hashName());
    }

    /** @test */
    public function some_of_user_fields_are_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $this->actingAs($admin)
            ->post(route('users.store'))
            ->assertSessionHasErrors([
                'name',
                'email',
                'position',
                'birthday',
                'slack',
                'client_id',
                'office_id',
                'password',
                'avatar',
            ]);
    }

    /**
     * Get input attributes.
     *
     * @return array
     */
    private function inputAttributes()
    {
        $this->userFixture->set('avatar', $this->file);
        $this->userFixture->set('password', 'secret');
        $this->userFixture->set('password_confirmation', 'secret');

        return $this->userFixture->attributes();
    }

    /**
     * Get result attributes.
     *
     * @return array
     */
    private function resultAttributes()
    {
        $this->userFixture->set('avatar', 'avatars/'.$this->file->hashName());
        $this->userFixture->remove(['password', 'password_confirmation']);

        return $this->userFixture->attributes();
    }
}
