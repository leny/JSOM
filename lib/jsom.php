<?php
/* JSOM
 * json-based object model
 *
 * Version   : 0.1
 * Date      : 2011-12-05
 * Licence   : GPL v3 : http://www.gnu.org/licenses/gpl.html  
 * Author    : Pierre-Antoine "leny" DELNATTE / flatLand!
 * Contact   : lisarael@gmail.com
 * Web site  : http://github.com/leny/JSOM
 *   
 * Copyright (c) 2011 Pierre-Antoine "leny" DELNATTE / flatLand!
 * All rights reserved.
 *   
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:
 * 
 *   - Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *   - Redistributions in binary form must reproduce the above 
 *     copyright notice, this list of conditions and the following 
 *     disclaimer in the documentation and/or other materials provided 
 *     with the distribution.
 *   - Neither the name of the author nor the names of its contributors 
 *     may be used to endorse or promote products derived from this 
 *     software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.
 */

abstract class JSOM {
	
	public static function changeVersionHistorySize( $iSize ) {
		JSOM::$_iVersionHistorySize = $iSize;
	} // changeVersionHistorySize

	public function __get( $sName ) {
		if( isset( $this->_aData[ $sName ] ) )
			return $this->_isVersionned( $sName ) ? $this->_getVersionned( $sName ) : $this->_aData[ $sName ];
		else {
			trigger_error( "Property '" . $sName . "' doesn't exists on '" . get_called_class() . "' !", E_USER_NOTICE );	
			return null;
		}
	} // __get

	public function __set( $sName, $mValue ) {
		if( isset( $this->_aData[ $sName ] ) ) {
			if( $this->_isVersionned( $sName ) ) { 
				$this->_setVersionned( $sName, $mValue );
			} else { 
				$this->_aData[ $sName ] = $mValue; 
			}
		} else {
			trigger_error( "Property '" . $sName . "' doesn't exists on '" . get_called_class() . "' !", E_USER_NOTICE );	
		}
	} // __set

	public function prop( $mKeyOrProps, $mValue = null ) {
		// same behaviour as .css in jquery
		return $this;
	} // set

	public function __construct( $sPath ) {
		$this->_sFilePath = $sPath;
		return file_exists( $this->_sFilePath ) ? $this->_load() : $this->_create();
	} // __construct

	protected function _create( $aData=null ) {
		$this->_aData = $aData;
		return $this->_save( true );
	} // _create

	protected function _load() {
		$this->_aJSONData = json_decode( file_get_contents( $this->_sFilePath ), true );
		$this->_aData = $this->_aJSONData;
		return $this;
	} // _load

	protected function _save( $bForce = false ) {
		if( $this->_aJSONData === $this->_aData && !$bForce )
			return true;
		if( file_put_contents( json_encode( $this->_sFilePath ), $this->_aData ) === false )
			return false && trigger_error( "Can't save file in '" . $this->_sFilePath . "' !", E_USER_ERROR );
		return true;
	} // _save

	protected $_aData;
	protected $_aJSONData;
	protected $_aDefaultData;

	protected $_sFilePath;
	protected $_aStructure;

	private function _isVersionned( $sName ) {
		return $this->_aStructure[ $sName ] && true;
	} // _isVersionned

	private function _setVersionned( $sName, $mValue ) {
		if( sizeof( $this->_aData[ $sName ] ) == JSOM::$_iVersionHistorySize ) {
			ksort( $this->_aData[ $sName ] ); // probably useless
			array_shift( $this->_aData[ $sName ] );	
		}
		$this->_aData[ $sName ][ time() ] = $mValue;
	} // _setVersionned

	private function _getVersionned( $sName ) {
		ksort( $this->_aData[ $sName ] ); // probably useless
		return end( $this->_aData[ $sName ] );
	} // _getVersionned

	private static $_iVersionHistorySize = 10;
} // class:JSOM