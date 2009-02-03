

/*************************************************************
 * Window Onload Manager (WOM) v1.0
 * Author: Justin Barlow - www.netlobo.com
 *
 * Description:
 * The WOM library of functions allows you to easily call multiple javascript functions when your page loads.
 *
 * Usage:
 * Add functions to WOM using the womAdd() function. Pass the name of your functions (with or without parameters) into womAdd(). Then call womOn() like this:
 *     womAdd('hideDiv()');
 *     womAdd('changeBg("menuopts","#CCCCCC")');
 *     womOn();
 * WOM will now run when your page loads and run all of the functions you have added using womAdd()
 *************************************************************/
var woms = new Array();
function womGo() {
	for(var i = 0;i < woms.length;i++)
		eval(woms[i]);
}

function womAdd(func) {
	woms[woms.length] = func;
}

window.onload = womGo;

/*************************************************************
 * getElementsByClassName()
 *
 * Returns an array of all elements of the given type, with the given class.  
 * If no tag name supplied, returns an array of all elements with the given class.
 * Usage:
 *    var myElements = getElementsByClassName('classname', DIV); //returns array of all DIV elements of class "classname"
 *    var myElements = getElementsByClassName('classname'); //returns array of all elements of class "classname"
 *************************************************************/
function getElementsByClassName(classname, tag) {
    if (!tag) {
        var obj = document.getElementsByTagName("*");
    } else {
        var obj = document.getElementsByTagName(tag);
    }
    var els = new Array();
    var a = 0;
    for (i = 0; i < obj.length; i++){
        if (obj[i].className.indexOf(classname) >= 0) {
            els[a++] = obj[i];
        }
    }
    return els;
}


/*************************************************************
 * findFirstElementByClassName(obj, cssClass)
 *
 * Returns the first HTMLElement of class cssClass
 * If no HTMLElement is found, returns false
 * @param options: object
 *          startAt: HTMLELementObject
 *          cssClass: String
 *          deep: Boolean, default false
 * Usage:
 * var first = findFirstElementByClassName({startAt: HTMLElementObject, cssClass: 'myStyle', recursive: false);
 * if (!first) { doSomething() }
 *************************************************************/
function findFirstElementByClassName(options)
{
    var deep = (empty(options.deep) || typeof options.deep != 'boolean' || options.deep == 0) ? false : options.deep;

    if (empty(options.startAt) || empty(options.cssClass)) {
        throw('findFirstElementByClassname() :: options.startAt || options.cssClass is empty!')
        return false;
    }
    
    var currentDOMElement = options.startAt;

    for (var i=0; i<currentDOMElement.childNodes.length; i++)
    {
        var currentElement = currentDOMElement.childNodes[i];
        if (currentElement.nodeType != 1) continue;
        if (currentElement.className.indexOf(options.cssClass) != -1)
        {
            return currentElement;
            break;
        }
        else if(currentElement.childNodes.length > 0 && deep)
        {
            var element = findFirstElementByClassName({startAt: currentElement, cssClass: options.cssClass, deep: deep});
        }
        if (!empty(element))
            return element;
    }
    return false;
}

/*************************************************************
 * findFirstElementByNodeName(nodeNameToFind, startAt, dir)
 *
 * Returns the first HTMLElement of nodeName 'nodeNameToFind'
 * If no HTMLElement is found, returns false
 * Usage:
 * var first = findFirstElementByNodeName('ul', HTMLListItemElement, 'back');
 * if (!first) { doSomething() }
 * @param options: object
 *       nodeNameToFind: String
 *       startAt: HTMLElementObject
 *       direction: String 'forward' || 'back', default 'forward'
 *************************************************************/
function findFirstElementByNodeName(options)
{
    if (empty(options.nodeNameToFind) || empty(options.startAt))
        return false;
        
    var dir = ((empty(options.direction) || (options.direction != 'forward' && options.direction != 'back'))) ? 'forward' : options.direction;
        
    var currentDOMElement = (dir == 'forward') ? options.startAt.childNodes[0] : options.startAt.parentNode;

    if (currentDOMElement)
        return (currentDOMElement.nodeName == options.nodeNameToFind.toUpperCase()) ? currentDOMElement : findFirstElementByNodeName({nodeNameToFind: options.nodeNameToFind, startAt: currentDOMElement, direction: dir});
    else
        return false;
}		

/*************************************************************
 * isString()
 *
 * Returns true/false depending on whether the given object is a string.
 * Usage:
 *   var myBoolean = isString("hello"); //returns true
 *   var myBoolean = isString(document.body); //returns false
 *   var myBoolean = isString(7); //returns false
 *************************************************************/
isString = function(object) {
    return typeof object == "string";
}

/*************************************************************
 * $()
 *
 * Prototype Framework's replacement for document.getElementById(), less the dom extensions.
 * If provided with a string argument, returns the element with an id of the given value.
 * If provided with an object, returns that object.
 * If provided with multiple arguments (either strings or object references), returns an array of those elements/ids.
 * Usage:
 *    var myElement = $('john'); //returns HTMLElement with id, "john";
 *    var myElement = $(document.body) //returns HTMLBodyElement;
 *    var myElements = $('john', document.body, 'paul', 'george' 'ringo'); //returns array of HTMLElements with the given ids, and HTMLBodyElement   
 *************************************************************/
function $(element) {
  if (arguments.length > 1) {
    for (var i = 0, elements = [], length = arguments.length; i < length; i++)
      elements.push($(arguments[i]));
    return elements;
  }
  if (isString(element))
    element = document.getElementById(element);
  return element;
}


function empty () { if (arguments[0] == null || typeof arguments[0] == "undefined" || arguments[0] == "undefined" || arguments[0] == "") return true; else return false;};




//TODO: look at old cvs shared js scripts

