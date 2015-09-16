/*
|--------------------------------------------------------------------------
| Developer mode
|--------------------------------------------------------------------------
|
| Set to true - it will allow printing in the console. Alsways check for this
| variables when running tests so you dont forget about certain console.logs.
| Id needed for development testing this variable should be used.
|
*/
var devMode = function() {
	return true;
};

/**
 * Run alert only if devMode is on. This is only for testing purposes, if the
 * alert is needed use the normal alert().
 */
var devAlert = function( string ) {
	if ( devMode() ) {
		alert( devMode() );
	}
}

// Disable console.log for production site.
if ( ! devMode() ) {
	console.log = function() {}

	// This is too much, so maybe keep it commented.
	// console.error = function() {}
}


/**
 * Those will be events like clicking, dragging, scrolling or whatever
 * that will change afer certain user interaction with the site. Default
 * changes that are happening whitout the controll of the user should be
 * in another object. Keep the WordPress coding guidelines for javascript.
 */
var siteEvents = (function () {
	'use strict';

	/**
	 * Settings. Its ok to use jquery selectors in the functions and not
	 * set them here, but if they are used in more then one function and
	 * can be used as setting (like fixed element height) better to  set
	 * it here.
	 */
	var _s = {};

	/**
	 * Fire all functions that will be used in the page.
	 */
	var events = function () {};

	/**
	 * Call the events.
	 * -> siteEvents.watch();
	 */
	return {
		watch: events,
	};

})();


jQuery( document ).ready( function ( $ ) {

	// Begin watching for events.
	siteEvents.watch();

});