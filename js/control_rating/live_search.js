/**
 * @author Ryan Johnson <ryan@livepipe.net>
 * @copyright 2007 LivePipe LLC
 * @package Control.LiveSearch
 * @license MIT
 * @version 1.0.0
 * 
 * This script is not officially part of the Control Suite. It will be soon though!
 */
if(typeof(Control) == "undefined")
	var Control = {};
Control.LiveSearch = Class.create();
Object.extend(Control.LiveSearch.prototype,{
	initialize: function(element,options){
		this.isOpen = false;
		this.timeout = false;
		this.element = $(element);
		this.options = Object.extend({
			container: false,
			defaultText: 'Search',
			altColor: false,
			timeout: 500,
			updateUrl: false,
			updateParameterName: 'query',
			closeOnEscKey: true,
			afterChange: Prototype.emptyFunction,
			beforeOpen: Prototype.emptyFunction,
			afterOpen: Prototype.emptyFunction,
			beforeClose: Prototype.emptyFunction,
			afterClose: Prototype.emptyFunction
		},options || {});
		if(this.options.container){
			this.options.container = $(this.options.container);
			this.oldContents = this.options.container.innerHTML;
		}
		if(this.options.altColor)
			this.element.style.color = this.options.altColor;
		this.element.value = this.options.defaultText;
		this.element.observe('focus',function(){
			if(this.element.value == this.options.defaultText){
				if(this.options.defaultText)
					this.element.value = '';
				if(this.options.altColor)
					this.element.style.color = null;
			}
		}.bind(this));
		this.element.observe('blur',function(){
			if(this.element.value == ''){
				if(this.options.defaultText)
					this.element.value = this.options.defaultText;
				if(this.options.altColor)
					this.element.style.color = this.options.altColor;
			}
		}.bind(this));
		this.element.observe('keyup',this.onChange.bind(this));
		this.element.observe('change',this.onChange.bind(this));
		if(this.options.closeOnEscKey){
			Event.observe(window,'keydown',function(event){
				if(event.keyCode == Event.KEY_ESC && this.isOpen)
					this.close();
			}.bindAsEventListener(this));
		}
	},
	onChange: function(){
		if(this.element.value != ''){
			if(this.timeout)
				window.clearTimeout(this.timeout);
			this.timeout = window.setTimeout(function(){
				if(this.element.value != '' && this.options.updateUrl){
					var params = {};
					params[this.options.updateParameterName] = this.element.value;
					new Ajax.Request(this.options.updateUrl,{
						parameters: params,
						onComplete: function(request){
							this.open(request.responseText);
						}.bind(this)
					});
				}
				this.notify('afterChange');
			}.bind(this),this.options.timeout);
		}
	},
	open: function(text){
		if(this.notify('beforeOpen') === false)
			return false;
		this.isOpen = true;
		if(this.options.container)
			this.options.container.update(text);
		this.notify('afterOpen');
		return true;
	},
	close: function(){
		if(this.notify('beforeClose') === false)
			return false;
		this.isOpen = false;
		if(this.timeout)
			window.clearTimeout(this.timeout);
		if(this.options.container)
			this.options.container.update(this.oldContents);
		if(this.options.defaultText)
			this.element.value = this.options.defaultText;
		this.element.blur();
		this.notify('afterClose');
		return true;
	},
	notify: function(event_name){
		try{
			if(this.options[event_name])
				return [this.options[event_name].apply(this.options[event_name],$A(arguments).slice(1))];
		}catch(e){
			if(e != $break)
				throw e;
			else
				return false;
		}
	}
});