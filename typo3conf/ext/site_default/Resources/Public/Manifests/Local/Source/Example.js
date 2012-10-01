/*
---

name: Example
description: Example just tween a height
license: MIT-style license.
requires: [Core/Element.Dimensions, Core/Fx.Tween]
provides: Example

...
*/

var Example = new Class({

	Implements: [Options, Events],

	options: {
		height: 200,
	},

	initialize: function(element, options) {
		this.element = document.id(element);
		this.doSomething();
	},

	doSomething: function() {
		this.element.tween('height', this.options.height);
	}

});