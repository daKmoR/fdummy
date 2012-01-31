	if(Ext.get('ext-cms-layout-db-layout-php')) {

		// add paste icons to column headers
		colHeader = Ext.select('.t3-page-colHeader').elements;
		Ext.each(colHeader, function(currentColHeader){
			var parentCell = Ext.get(currentColHeader).parent();
			if(Ext.get(parentCell).id.substr(0,6) != 'column') {
				var parentCellClass = Ext.get(parentCell).dom.className.split(' ');
				for(i = 0; i < parentCellClass.length; i++) {
					if(parentCellClass[i].substr(0,15) == 't3-page-column-') {
						var dropZoneID = 'DD_DROP_PIDx' + parentCellClass[i].substr(15);
					}
				};
			} else {
				var dropZoneID = Ext.get(parentCell).id;
			}

			var firstColHeaderLink = Ext.get(currentColHeader).select('.t3-page-colHeader-icons a:first').elements[0].cloneNode(true);
			var lastColHeaderLink = Ext.get(currentColHeader).select('.t3-page-colHeader-icons a:last').elements[0];

			firstColHeaderLink.title = 'Paste reference into';
			firstColHeaderIcon = Ext.get(firstColHeaderLink).select('span:first').elements[0];
			Ext.get(firstColHeaderIcon).removeClass('t3-icon-document-new');
			Ext.get(firstColHeaderIcon).addClass('t3-icon-document-paste-after');

			Ext.get(firstColHeaderLink).insertAfter(lastColHeaderLink);

		});

		// add paste icons to element headers
		/*var dropZoneEl = Ext.select('.t3-page-ce .t3-page-ce-body').elements;
		Ext.each(dropZoneEl, function(currentElement){
			var dropZoneID = Ext.get(currentElement).select('div.t3-page-ce-type span').elements[0].getAttribute('title');
			var currentDropZone = document.createElement('div');
			currentDropZone.innerHTML = dropZoneTpl;
			Ext.get(currentDropZone).select('div.x-dd-droptargetarea').set({title: dropZoneID});
			Ext.get(currentDropZone).addClass('x-dd-droptargetarea');
			Ext.get(currentDropZone).addClass('debugme');
			Ext.get(currentDropZone).insertAfter(currentElement);
		});*/

	}