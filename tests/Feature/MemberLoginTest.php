<?php

namespace Tests\Feature;

use App\Models\Member;
use Tests\TestCase;

class MemberLoginTest extends TestCase
{
    public function test_member_can_login()
    {
        $member = Member::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => $member->email,
            'password' => 'password',
            'role' => 'member',
        ]);

        $response->assertRedirect(route('member.dashboard'));
        $this->assertAuthenticatedAs($member, 'members');
    }

    public function test_member_cannot_access_admin()
    {
        $member = Member::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($member, 'members');

        $response = $this->get(route('admin.members.index'));
        $response->assertRedirect(route('login'));
    }
}
