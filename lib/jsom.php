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
		
	} // __get

	public function __set( $sName, $mValue ) {
		
	} // __set

	public function prop( $mKeyOrProps, $mValue = null ) {
		// same behaviour as .css in jquery
		return $this;
	} // set

	public function __construct( $sPath ) {
		$this->_sFilename = $sPath;
		return file_exists( $sPath ) ? $this->_load() : $this->_create();
	} // __construct

	protected function _create() {
		
	} // _create

	protected function _load() {
		
	} // _load

	protected function _save() {
		
	} // _save

	protected $_aData;
	protected $_aJSONData;

	protected $_sFilename;
	protected $_aStructure;

	private function _isVersionned( $sName ) {
		return $this->_aStructure[ $sName ] && true;
	} // _isVersionned

	private function _setVersionned( $sName, $mValue ) {
		
	} // _setVersionned

	private function _getVersionned( $sName ) {
		
	} // _getVersionned

	private static $_iVersionHistorySize = 10;

} // class:JSOM