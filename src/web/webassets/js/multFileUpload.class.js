<!--

/* MultFileUpload.js
 * options to be passed in class as js hash : ie. class={ maxFiles: 5, }
 * @param maxAttachedFiles	: maximum # of uploads allowed
 * @param removeFileLinkText : text to display on the remove file link
 * classname "multFileUpload" is required for the script to auto-convert the element
 * end result is the following:
 * 
	<td class="multFileUpload {maxFiles:5,displayCounterTextNoMoreUploads: 'You cannot upload anymore files.', displayCounterText: 'Holy Carp! You can upload another %%numFiles%% file(s)!!!', removeFileLinkText: 'Begone, vile file chile!'}">
		<input type="file" id="app0_upload[4]" name="app0_upload[4]"/>
		<input type="file" id="app0_upload[3]" name="app0_upload[3]" style="display: none;"/>
		<input type="file" id="app0_upload[2]" name="app0_upload[2]" style="display: none;"/>
		<div id="multFileUpload_fileList_0" class="multFileUpload_fileList">
			<p id="multFileUpload_displayCounter0" class="multFileUpload_displayCounter">Holy Carp! You can upload another 3 file(s)!!!</p>
			<div id="fileListRow_0_1" class="multFileUpload_fileListRow">
				<div id="fileListText_0_1" class="multFileUpload_fileListText">index.html~</div>
				<a href="javascript:void(0);" id="removeFileLink_0_1" class="multFileUpload_removeFileLink">Remove File</a></div><div id="fileListRow_0_2" class="multFileUpload_fileListRow"><div id="fileListText_0_2" class="multFileUpload_fileListText">multFileUpload.css</div><a href="javascript:void(0);" id="removeFileLink_0_2" class="multFileUpload_removeFileLink">Begone, vile file chile!</a>
			</div>
		</div>
	</td>
 *
 */


var MultFileUpload = Class.create();
MultFileUpload.prototype = {
	/* initialize:
	 * set default options, check if options are passed
	 * @param elementToConvert : the HTML element to convert to mult file upload
	 * @param numFilesAdded : number of files added (to check against maxFiles option)
	 * @param fileCount : used for ids/names of file inputs and other elements
	 * @param index : the index number of this intance of the class on the page
	 * @param defaultOptions : default options for class
	 * 
	 */
	initialize: function(elementToConvert, index)
	{
		//element to convert
		this.elementToConvert = elementToConvert;

		//file counter
		this.numFilesAdded = 0;
		
		//counter for ids, to avoid duplicates
		this.fileCount = 0;

		//# of these objects on page...
		this.index = index;

		//set default options
		this.defaultOptions = {
				maxFiles:      1,
				removeFileLinkText:    'Remove File',
				displayCounterText:  'You may upload %%numFiles%% more files.',
				displayCounterTextNoMoreUploads: 'You cannot upload anymore files.'
		},

		//get user options		
		this.getUserOptions();
		
		//set options
		this.setOptions();

		//find the file input to set up the onchange handler.
		this.findFileInput();
		
		//create the fileList element
		this.createFileList();
		
		//add one to begin
		if (!this.empty(this.fileInput))
			this.setupFileInput();
		else
			return false;
	},

	/* getUserOptions:
	 * gets the user-passed variables, if any
	 * 
	 */
	getUserOptions: function()
	{
		
		var userOptionsStart = this.elementToConvert.className.indexOf('{');
		var userOptionsEnd = this.elementToConvert.className.indexOf('}');
		var userOptions = this.elementToConvert.className.substr(userOptionsStart-1, userOptionsEnd+1);
		eval('this.userOptions = '+userOptions);
	},

	/* setOptions:
	 * merges defaultOptions with userOptions
	 * @returns this.options : $H
	 */
	setOptions: function()
	{
		this.defaultOptions = $H(this.defaultOptions);
		this.userOptions = $H(this.userOptions);	
		this.options = this.defaultOptions.merge(this.userOptions);
	},

	/* empty
	 *
	 * checks a passed value for null or undefined
	 * returns boolean
	 *
	 */

	empty: function (variable)
	{
		return (typeof variable == 'undefined' || variable == null || variable == '' ) ? true : false;
	},

	/* createFileList
	 *
	 * creates a div within the elementToConvert to append file name + remove button to
	 * returns fileList (HTML Element)
	 *
	 */
	createFileList: function()
	{
		var fileList = document.createElement('DIV');
		fileList.id = 'multFileUpload_fileList_'+this.index;
		var displayCounter = document.createElement('P');
		displayCounter.id = 'multFileUpload_displayCounter'+this.index;
	  Element.extend(displayCounter);
    Element.extend(fileList);
    
    fileList.appendChild(displayCounter);
		this.elementToConvert.appendChild(fileList);
		
    //add classname after appended to DOM for IE...
    displayCounter.addClassName('multFileUpload_displayCounter');
    fileList.addClassName('multFileUpload_fileList');		
    
    this.fileList = $(fileList.id);
		this.displayCounter = $(displayCounter.id);
		this.updateDisplayCounter();
	},


	/* findFileInput
	 *
	 * finds the actual file input 
	 * returns fileInput (HTML element)
	 *
	 */
	findFileInput: function()
	{
		this.fileInput = this.elementToConvert.getElementsBySelector('input[type=file]');
		this.fileInput = this.fileInput[0];
	},

	/* setupFileInput
	 *
	 * sets up the onChange handler on the fileInput
	 * if numFilesAdded < maxFiles
	 *
	 */
	setupFileInput: function ()
	{

		if (this.numFilesAdded < this.options.maxFiles)
		{		
			this.fileInput.name = this.fileInput.id;	
			this.addFileBinding = this.addFileInput.bindAsEventListener(this);	
			Event.observe($(this.fileInput.id), 'change', this.addFileBinding);
		}
		else
		{
			this.fileInput.disabled = true;			
			Event.stopObserving($(this.fileInput.id), 'change', this.addFileBinding);
		}
	},
	
	/* addFileInput
	 *
	 * adds a new file input element
	 * and disables the old one
	 *
	 */
	addFileInput: function ()
	{
		//increase counters
		this.numFilesAdded++;
		this.fileCount++;
		
		//remove the old listener
		Event.stopObserving($(this.fileInput.id), 'change', this.addFileBinding);		
	    
		var new_element = document.createElement( 'input' );
	    new_element.type = 'file';
	    new_element.id = this.fileInput.id.substring(0, this.fileInput.id.indexOf("["));
	    new_element.id += "[" + this.fileCount + "]";
		this.fileInput.parentNode.insertBefore(new_element,this.fileInput);
	    this.fileInput.style.display = 'none';

	    this.addListRow();
		
		//setup the new file element
		this.fileInput = new_element;					
		this.setupFileInput();
	
	},
	
	/* addListRow
	 *
	 * adds a list row of text + remove button to the fileList element
	 * sets up the binding for the remove button
	 *
	 */
	addListRow: function()
	{
		
		//create new div
		var fileListRow = document.createElement('DIV');
		Element.extend(fileListRow);
    fileListRow.id = 'fileListRow_'+this.index+'_'+this.numFilesAdded;
		
		//create text
		var fileListText = document.createElement('DIV');
		Element.extend(fileListText);
    fileListText.id = 'fileListText_'+this.index+'_'+this.numFilesAdded;
		
		//create delete button
		var removeFileLink = document.createElement('A');
    Element.extend(removeFileLink);
		removeFileLink.href = 'javascript:void(0);';
		removeFileLink.id = 'removeFileLink_'+this.index+'_'+this.numFilesAdded;
		
		//append children to new list row
		fileListRow.appendChild(fileListText);		
		fileListRow.appendChild(removeFileLink);
		
		//append the new row to the list div
		this.fileList.appendChild(fileListRow);
		
		//add the classNames after appending to DOM, for IE...
    fileListRow.addClassName('multFileUpload_fileListRow');
    fileListText.addClassName('multFileUpload_fileListText');
    removeFileLink.addClassName('multFileUpload_removeFileLink');
    
    //update() after too...
    fileListText.update(this.getBasename(this.fileInput.value));
    removeFileLink.update(this.options.removeFileLinkText);
    
    this.updateDisplayCounter();

		//bind the remove button to removeFile()
		this.removeFileBinding = this.removeFile.bindAsEventListener(this, this.fileInput, fileListRow, removeFileLink);
		Event.observe($(removeFileLink.id), 'click', this.removeFileBinding);

		//show the div if need be
		if (!this.fileList.visible())
			this.fileList.show();		
	},

	/* updateDisplayCounter
	 *
	 * updates the display counter text with remaining spots available.
	 *
	 */
	updateDisplayCounter: function()
	{
		this.remainingUploads = String(this.options.maxFiles - this.numFilesAdded);
		if (this.remainingUploads > 0)
			this.displayCounter.update(this.options.displayCounterText.replace('%%numFiles%%', this.remainingUploads))
		else
			this.displayCounter.update(this.options.displayCounterTextNoMoreUploads);
	},

	/* removeFile
	 *
	 * removes file input, and corresponding list row, and button event
	 * reeanables the fileInput if need be.
	 *
	 */
	removeFile: function()
	{
		
		this.numFilesAdded--;
		//remove event on button
		Event.stopObserving($(arguments[3].id), 'click', this.removeFileBinding);
		
		//remove fileInput
		$(arguments[1].id).remove();

		//remove the list link
		$(arguments[3].id).remove();

		//remove the list row
		$(arguments[2]).remove();

		//reenable the file input
		if (this.fileInput.disabled == true)
		{
			this.fileInput.disabled = false;
			this.setupFileInput();
		}

		if (!this.fileInput.visible())
			this.fileInput.show();

		this.updateDisplayCounter();
		
	},
	
	/* getBasename
	 *
	 * returns the basename() of the file input value
	 * returns fileName
	 *
	 */
	getBasename: function(file)
	{
		fullFileName = new String(file);
		fileNameStartIndex = fullFileName.lastIndexOf("/");
	    return fullFileName.substr(fileNameStartIndex+1, fullFileName.length);
	}
	
}
	


var classNameToConvert = 'multFileUpload';

function createMultFileUploads()
{
	var elementsToConvert = $$('.'+classNameToConvert);
	var count = 0;
	//max files is passed in the class as 'maxFiles:xx'
	var multFileUploads = new Array();
  
	elementsToConvert.each(function(item){
    multFileUploads[count] = new MultFileUpload(item, count);
		count++;
	});
	
	
}

//auto do this to all items classed as a multFileUpload
Event.observe(window, 'load', createMultFileUploads);


//-->
