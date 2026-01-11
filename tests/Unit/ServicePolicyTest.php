<?php

namespace Tests\Unit;

use App\Models\Service;
use App\Models\User;
use App\Policies\ServicePolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicePolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_any_service()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $service = Service::factory()->create();

        $policy = new ServicePolicy();

        $this->assertTrue($policy->update($admin, $service));
    }

    public function test_provider_can_update_own_service()
    {
        $provider = User::factory()->create(['role' => 'provider']);
        $service = Service::factory()->create(['provider_id' => $provider->id]);

        $policy = new ServicePolicy();

        $this->assertTrue($policy->update($provider, $service));
    }

    public function test_provider_cannot_update_others_service()
    {
        $provider = User::factory()->create(['role' => 'provider']);
        $otherProvider = User::factory()->create(['role' => 'provider']);
        $service = Service::factory()->create(['provider_id' => $otherProvider->id]);

        $policy = new ServicePolicy();

        $this->assertFalse($policy->update($provider, $service));
    }
}
