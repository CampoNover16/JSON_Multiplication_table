<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MultiplicationTableTest extends TestCase
{
    public function test_is_page_returns_ok(){
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_that_checks_if_json_is_retrieved_if_proper_value_given(){
        $response = $this->get('/size/10');
        $response->assertStatus(200);
    }

    public function test_it_throws_error_if_value_is_out_of_range(){
        $response = $this->get('/size/150');
        $response->assertStatus(422);
    }

    public function test_it_throws_error_if_value_is_not_a_number(){
        $response = $this->get('/size/number');
        $response->assertStatus(422);
    }
}
