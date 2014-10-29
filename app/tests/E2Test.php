<?php
class E2Test extends TestCase {
	
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample() {
		$crawler = $this->client->request ( 'GET', 'admin/dash-board' );
		
		$this->assertResponseOk();
		
		$this->assertResponseStatus(200);
	}
}
