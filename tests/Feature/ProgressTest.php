<?php

namespace Tests\Feature;

use App\Models\Progress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProgressTest extends TestCase
{

    public function test_status(){
        $user = User::factory()->create();
        $progress = Progress::create([
            'poids' => 100,
            'taille' => 100,
            'age' =>    100,         
            'chest' => 50,
            'bicep' => 50,
            'leg' => 50,
            'user_id' => 4,
        ]);
        $response = $this->actingAs($user)->patch("/api/status/" . $progress->id);

        $response->assertStatus(200)->assertJson([
            'status' => true,
            'message' => 'your session is complete !',
        ]);

        $this->assertDatabaseHas('progresses',[
            'id' => $progress->id,
            'status' => 'términé',
        ]);
    }
}