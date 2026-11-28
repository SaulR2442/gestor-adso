<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_admin_can_access_user_management(): void
    {
        $response = $this->actingAs($this->admin())->get('/admin/users');

        $response->assertOk();
        $response->assertSee('Usuarios');
        $response->assertSee('Nuevo usuario');
    }

    public function test_admin_sees_the_users_link_in_the_navigation(): void
    {
        $response = $this->actingAs($this->admin())->get('/aprendices');

        $response->assertOk();
        $response->assertSee('Usuarios');
    }

    public function test_admin_can_create_other_users(): void
    {
        $response = $this->actingAs($this->admin())->post('/admin/users', [
            'name' => 'Nuevo Usuario',
            'email' => 'nuevo@example.com',
            'role' => 'instructor',
            'password' => 'Password123!',
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'nuevo@example.com',
            'role' => 'instructor',
        ]);
    }

    public function test_admin_can_update_other_users(): void
    {
        $user = User::factory()->create(['role' => 'aprendiz']);

        $response = $this->actingAs($this->admin())->put("/admin/users/{$user->id}", [
            'name' => 'Usuario Actualizado',
            'email' => 'actualizado@example.com',
            'role' => 'instructor',
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Usuario Actualizado',
            'email' => 'actualizado@example.com',
            'role' => 'instructor',
        ]);
    }

    public function test_admin_can_delete_other_users(): void
    {
        $user = User::factory()->create(['role' => 'aprendiz']);

        $response = $this->actingAs($this->admin())->delete("/admin/users/{$user->id}");

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_cannot_delete_themselves(): void
    {
        $admin = $this->admin();

        $response = $this->actingAs($admin)->delete("/admin/users/{$admin->id}");

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }

    public function test_admin_cannot_remove_their_own_admin_role(): void
    {
        $admin = $this->admin();

        $response = $this->actingAs($admin)->put("/admin/users/{$admin->id}", [
            'name' => $admin->name,
            'email' => $admin->email,
            'role' => 'aprendiz',
        ]);

        $response->assertSessionHas('error');
        $this->assertSame('admin', $admin->refresh()->role);
    }

    public function test_instructor_cannot_access_user_management(): void
    {
        $instructor = User::factory()->create(['role' => 'instructor']);

        $this->actingAs($instructor)
            ->get('/admin/users')
            ->assertForbidden();
    }

    public function test_aprendiz_cannot_access_user_management(): void
    {
        $aprendiz = User::factory()->create(['role' => 'aprendiz']);

        $this->actingAs($aprendiz)
            ->get('/admin/users')
            ->assertForbidden();
    }

    public function test_non_admin_users_do_not_see_the_users_link(): void
    {
        foreach (['instructor', 'aprendiz'] as $role) {
            $user = User::factory()->create(['role' => $role]);

            $response = $this->actingAs($user)->get('/aprendices');

            $response->assertOk();
            $response->assertDontSee('Usuarios');
        }
    }
}
