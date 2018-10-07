<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class HealthProfessionalAPITest extends TestCase {

    use WithoutMiddleware;
    use DatabaseTransactions;

    //******************Method index*******************************

    public function test_Index() {
        $this->get('/api/healthprofessionalbridgeprocess', ['accept' => 'application/json'])
                ->assertStatus(204);
        //->assertJson($user->toArrray());
    }

    //******************Method store*******************************

    public function test_store_withoutParameters_return422() {

        $this->post('/api/healthprofessionalbridgeprocess', [1], ['accept' => 'application/json'])
                ->assertStatus(422);
    }

    public function test_store_withIdHealthAndSystemProcessIdCorrectAndFirstToCreate_return201() {

        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json'])
                ->assertStatus(201);
    }

    public function test_store_withIdHealthAndSystemProcessIdCorrectAndFirstToCreate_return208() {

        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json'])
                ->assertStatus(208);
    }

    //******************Method getIdHealthProfessionalBySystemProcessId*******************************

    public function test_getIdHealthProfessionalBySystemProcessId_withoutParameters_return422() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/systemprocessid/', ['accept' => 'application/json'])
                ->assertStatus(422);
    }

    public function test_getIdHealthProfessionalBySystemProcessId_withSystemProcessId_return422() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/systemprocessid/1', ['accept' => 'application/json'])
                ->assertStatus(422);
    }

    public function test_getIdHealthProfessionalBySystemProcessId_withCorrectSystemProcessIdANDWrongIdApp_return204() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/systemprocessid/1?idApp=2', ['accept' => 'application/json'])
                ->assertStatus(204);
    }

    public function test_getIdHealthProfessionalBySystemProcessId_withCorrectSystemProcessIdANDCorrectIdApp_return200() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/systemprocessid/1?idApp=1', ['accept' => 'application/json'])
                ->assertStatus(200);
    }

    //******************Method getSystemProcessIdByIdHealthProfessiona*******************************

    public function test_getSystemProcessIdByIdHealthProfessional_withIdHealthProfessional_return422() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/39', ['accept' => 'application/json'])
                ->assertStatus(422);
    }

    public function test_getSystemProcessIdByIdHealthProfessional_withCorrectSystemProcessIdANDWrongIdApp_return204() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/39?idApp=2', ['accept' => 'application/json'])
                ->assertStatus(204);
    }

    public function test_getSystemProcessIdByIdHealthProfessional_withCorrectSystemProcessIdANDCorrectIdApp_return200() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/39?idApp=1', ['accept' => 'application/json'])
                ->assertStatus(200);
    }

    //******************Method getHealthProfessionalBridgeInfoByIdHealthProfessionalAndSystemProcessId*******************************
    public function test_getHealthProfessionalBridgeInfoByIdHealthProfessionalAndSystemProcessId_withIdHealthProfessional_return422() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/39', ['accept' => 'application/json'])
                ->assertStatus(422);
    }

    public function test_getHealthProfessionalBridgeInfoByIdHealthProfessionalAndSystemProcessId_withCorrectSystemProcessIdANDIdHealthProfessionalANDWrongIdApp_return204() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/39/1?idApp=2', ['accept' => 'application/json'])
                ->assertStatus(204);
    }

    public function test_getHealthProfessionalBridgeInfoByIdHealthProfessionalAndSystemProcessId_withCorrectSystemProcessIdANDIdHealthProfessionalCorrectIdApp_return200() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/39/1?idApp=1', ['accept' => 'application/json'])
                ->assertStatus(200);
    }
    
    //******************Method getHealthProfessionalBridgeInfoByIdHealthProfessionalAndExternalProcessId*******************************
    public function test_getHealthProfessionalBridgeInfoByIdHealthProfessionalAndExternalProcessId_withIdHealthProfessional_return422() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/39/externalprocessid/1', ['accept' => 'application/json'])
                ->assertStatus(422);
    }

    public function test_getHealthProfessionalBridgeInfoByIdHealthProfessionalAndExternalProcessId_withCorrectSystemProcessIdANDIdHealthProfessionalANDWrongIdApp_return204() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/39/externalprocessid/1?idApp=2', ['accept' => 'application/json'])
                ->assertStatus(204);
    }

    public function test_getHealthProfessionalBridgeInfoByIdHealthProfessionalAndExternalProcessId_withCorrectSystemProcessIdANDIdHealthProfessionalANDCorrectIdApp_return200() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/39/externalprocessid/1?idApp=1', ['accept' => 'application/json'])
                ->assertStatus(200);
    }
    
    //update status must not return after any record
    
    public function test_InsertAndUpdateHealthRecordWithStateOff_withCorrectSystemProcessIdANDCorrectIdApp_return204() {
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 1], ['accept' => 'application/json']);
        $this->post('/api/healthprofessionalbridgeprocess', ['idHealthProfessional' => 39, 'systemProcessId' => 1, 'idApp' => 1, 'state' => 0], ['accept' => 'application/json']);

        $this->get('/api/healthprofessionalbridgeprocess/39?idApp=1', ['accept' => 'application/json'])
                ->assertStatus(204);
    }

}
