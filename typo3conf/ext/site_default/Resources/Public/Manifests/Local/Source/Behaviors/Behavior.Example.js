/*
---
name: Behavior.Example
description: Adds a Example interface
provides: [Behavior.Example]
requires: [Behavior/Behavior, Example]
script: Behavior.Example.js

...
*/

Behavior.addGlobalFilter('Example', {

	defaults: {

	},

	setup: function(element, api) {
		return new Example(element);
	}

});