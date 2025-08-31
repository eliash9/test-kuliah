<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RoleProtectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_access_admin_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($admin)->get('/questions');
        $response->assertStatus(200);
    }

    /** @test */
    public function student_cannot_access_admin_routes()
    {
        $student = User::factory()->create(['role' => 'mahasiswa']);
        
        $response = $this->actingAs($student)->get('/questions');
        $response->assertStatus(302); // Redirected to dashboard with error
    }

    /** @test */
    public function student_can_access_student_routes()
    {
        $student = User::factory()->create(['role' => 'mahasiswa']);
        
        $response = $this->actingAs($student)->get('/answers/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_cannot_access_student_only_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($admin)->get('/answers/create');
        $response->assertStatus(302); // Redirected to dashboard with error
    }

    /** @test */
    public function guest_cannot_access_protected_routes()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(302); // Redirected to login
    }
}
