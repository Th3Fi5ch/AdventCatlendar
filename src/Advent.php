<?php

class Advent {
	private $participants;
	private $saveFileName;

	public function __construct( $saveFileName ) {
		$this->saveFileName = $saveFileName;
		$this->participants = $this->loadParticipants();
	}

	public function getWinner() {
		return $this->arrayMtRand( $this->getPossibleCandidates() );
	}

	public function confirmWinner( $name ) {
		if ( !array_key_exists( $name, $this->participants ) ) {
			throw new Exception( 'Wait a minute! Your not even in the list!' );
		}
		if ( $this->lastWinningDay() >= $this->today() ) {
			throw new Exception( 'Wait a minute! You already got something today!' );
		}

		$this->increaseWinningCount( $name );
		$this->saveParticipants();

		return true;
	}

	private function getMinWins() {
		return min( $this->participants );
	}

	private function getPossibleCandidates() {
		return array_filter( $this->participants, array( $this, 'candidatesFilter' ) );
	}

	private function increaseWinningCount( $name ) {
		$this->participants[$name]++;
	}

	private function candidatesFilter( $value ) {
		return $this->getMinWins() === $value;
	}

	private function lastWinningDay() {
		return array_sum( $this->participants );
	}

	private function today() {
		return date( 'j' );
	}

	private function loadParticipants() {
		return json_decode( file_get_contents( $this->saveFileName ), true );
	}

	private function saveParticipants() {
		file_put_contents( $this->saveFileName, json_encode( $this->participants, JSON_PRETTY_PRINT ) );
	}

	private function arrayMtRand( Array $array ) {
		$count = count( $array );
		if ( !$count ) return null;

		$arrayKeys = array_keys( $array );
		return $arrayKeys[mt_rand( 0, $count - 1 )];
	}

}
