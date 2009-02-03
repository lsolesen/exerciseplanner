/*************************************************************
 *  Simple drop-down/expandable menu script
 *  Creates css/javascript-based menu system from nested ULs
 *
 * 1) Create menu structure using anchors, in nested ULs, with sub-menus nested inside the parent LI:
 *     <ul class="ulNav dropNav">
 *         <li><a href="">Item</a></li>
 *         <li><a href="">Item</a>
 *             <ul>
 *                 <li><a href="">Sub-item</a></li>
 *             </ul>
 *         </li>
 *     </ul>
 * 2) Give root UL class name of "ulNav ***", "***" being either "dropNav" for drop-down menu, or "clickNav" for click-deployed expanding menu
 * 3) Give root UL an additional class of "flyUp" to have the menu open upward rather than downward
 *
 * Use in conjunction with ulNav.css
 * Javascript required for expandable menu (requires separate <noscript> version of expanded menu for non-js browsers.
 * Drop-down menu will work sans-javascript in any browser supporting :hover on non-anchor elements, but js is required for:
 *     - MSIE 6.0 and older
 *     - Delay on menu-collapse
 *     - Off-screen menu detection
 * Do not apply an inline style="left:" to any LI element (will interfere with off-screen detection)
 *
 * To keep the menu for the current page deployed, replace "sfhide" with "sfcurrent" for the appropriate menu
 *************************************************************/

var delay = 250; /** Time, in milliseconds, for the dropdown to remain deployed after mouseout. 1000 = 1 second, 500 = 0.5 seconds, etc */
var bgIframe = new Array();
var bgIframeCount = 0;
var timerID = 0;
var timers = new Array();
var timersIdEl = new Array();

removeHover = function(el, tid) {
    /** tid (timer ID) is optional, passed only from setTimeout call of removeHover */
    if (el == "") {
        /** If el is empty string, retrieve element from timersIdEl using tid passed from setTimeout call */
        el = timersIdEl[tid];
    }
    el.className = el.className.replace(new RegExp("hover\\b"), "") /** Remove hover class from LI */
    if (el.hasTimer) {
        /** If el had delay timer, clear it */
        clearTimeout(el.timerId);
        el.hasTimer = false;
    }
    if (el.hasOffset == true && el.childUlIndex >= 0) {
        /** If the dropdown was moved to clear the screen edge, move it back */
        el.childNodes[el.childUlIndex].style.left = null;
        el.hasOffset = false;
    }
} /** /removeHover function */


shimIframe = function(el, ulNode) {
    /** Create a transparent Iframe, and shim it underneath the dropdown UL, to compensate for lack of z-index on windowed elements
     * el = element
     * ulNode = childNode[value] of child UL */
    bgIframe[bgIframeCount] = document.createElement('iFrame');
    var containLi = document.createElement('LI');
    containLi.style.borderWidth = "0px";
    containLi.style.height = "0px";
    containLi.className = "bgIframeCont";
    bgIframe[bgIframeCount].id = "bgIframe"+bgIframeCount;
    /** Match dimensions and position of associated dropdown */
    bgIframe[bgIframeCount].style.height = parseInt(el.childNodes[ulNode].offsetHeight) + "px";
    bgIframe[bgIframeCount].style.width = parseInt(el.childNodes[ulNode].offsetWidth) + "px";
    bgIframe[bgIframeCount].style.marginTop = "-" + parseInt(el.childNodes[ulNode].offsetHeight) + "px";
    el.assocBgIframe = bgIframe[bgIframeCount].id; /** Bind Iframe to current LI */
    /** Insert Iframe into markup */
    containLi.appendChild(bgIframe[bgIframeCount]);
    el.childNodes[ulNode].appendChild(containLi);
    bgIframeCount++;
} /** /shimIframe function */


sfHover = function() {
        var ulEls = getElementsByClassName("ulNav", "UL");
    /**Create array of all instances of given element with given classname */
    for (i = 0; i < ulEls.length; i++) {
        sfEls = new Array();
        sfEls[i] = ulEls[i].getElementsByTagName("LI"); /**Create array of all LI elements within each of ulEls */
        for (var ii = 0; ii < sfEls[i].length; ii++) {
            /** For each LI in ulEls... */
            /** For dropdown menu */
            if (ulEls[i].className.indexOf("dropNav") >= 0) {
                if (ulEls[i].className.indexOf("flyUp") >= 0)
                    sfEls[i][ii].flyUp = true;
                else
                    sfEls[i][ii].flyUp = false;
                sfEls[i][ii].hasOffset = false;
                sfEls[i][ii].needTimeout = false;
                for (c = 0; c < sfEls[i][ii].childNodes.length; c++) {
                    /** Check for a child UL within the LI.  If one exists, bind its index value to this.childUlIndex */
                    if (sfEls[i][ii].childNodes[c] && sfEls[i][ii].childNodes[c].nodeName == "UL") {
                        if(sfEls[i][ii].flyUp) {
                        /** If menu is supposed to open upward, move the UL upward a distance equal to it's height */
                            sfEls[i][ii].childNodes[c].style.top = sfEls[i][ii].childNodes[c].offsetTop - sfEls[i][ii].childNodes[c].offsetHeight + "px";
                        }
                        sfEls[i][ii].childUlIndex = c;
                    }
                }
                if (sfEls[i][ii].childUlIndex >= 0) {
                    /** If the Element has a child UL (submenu), it'll need a delay */
                    sfEls[i][ii].needTimeout = true;
                }
                //if (!window.XMLHttpRequest && document.body.currentStyle) { /** Restrict to IE lte 6.0 */
                    if (sfEls[i][ii].childUlIndex >= 0) {
                        /** If element has child UL, shim Iframe underneath the UL */
                        shimIframe(sfEls[i][ii], sfEls[i][ii].childUlIndex);
                    }
                //}
                
                
                sfEls[i][ii].onmouseover = function() {
                    for (c = 0; c < this.parentNode.childNodes.length; c++) {
                        /** We don't want a delay set if we're mousing off one element, and straight onto another, so on mouseover,
                         *  we need to clear the timer, and remove the hover, for every element (other than this one) at the same DOM level */
                        if (this.parentNode.childNodes[c] && this.parentNode.childNodes[c].nodeName == "LI" && this.parentNode.childNodes[c] != this) {
                            if(this.parentNode.childNodes[c].timerId) {
                                clearTimeout(this.parentNode.childNodes[c].timerId);
                                removeHover(this.parentNode.childNodes[c]);
                            }
                        }
                    }
                    if (this.className.indexOf("hover") >= 0) {
                        /** If the moused-over element is already expanded, check if it has a delay timer already running.
                         *  If it does, cancel it. */
                        if (this.hasTimer) {
                            clearTimeout(timers[this.timerId]);
                            this.hasTimer = false;
                        }
                    }
                    if (this.parentNode.parentNode.className.indexOf("hover") >= 0) {
                        /** If the moused-over element's parent is expanded, check if the parent has a delay timer running.
                         *  If it does, cancel it. */
                        if (this.parentNode.parentNode.hasTimer) {
                            clearTimeout(timers[this.parentNode.parentNode.timerId]);
                            this.parentNode.parentNode.hasTimer = false;
                        }
                    }
                    if (!(this.className.indexOf("hover") >= 0)) {
                        /** Apply hover class to moused over LI */
                                    this.className += " hover";
                    }
                    if (this.childUlIndex >= 0) {
                        /** If the dropdown UL will deploy past the screen edge, move it left until it clears */
                        var thisLeft = parseInt(this.childNodes[this.childUlIndex].offsetLeft);
                        var thisWidth = parseInt(this.childNodes[this.childUlIndex].offsetWidth);
                        var docWidth = parseInt(document.documentElement.offsetWidth);
                        if (thisLeft + thisWidth > docWidth) {
                            var offside = (thisLeft + thisWidth) - docWidth;
                            this.childNodes[this.childUlIndex].style.left = thisLeft - offside - 20 + "px";
                            this.hasOffset = true;
                        }
                    }
                        } /** /mouseover function */
        
        
                sfEls[i][ii].onmouseout = function() {
                    if (this.needTimeout == true) {
                        /** If the moused-out element needs a delay... */
                        if (!this.timerId) {
                            /** If the moused-over element doesn't have a delay timer already bound to it, create one */
                            this.timerId = timerID++;
                        }
                        timersIdEl[this.timerId] = this; /** We can't pass 'this' into setTimeout, so we need to associate 'this' to its delay timer at the global scope */
                        if (this.hasTimer) {
                            /** If the moused-out element already has a timer running, clear it */
                            clearTimeout(timers[this.timerId]);
                            this.hasTimer = false;
                        }
                        var localTimer = this.timerId; /** setTimeout doesn't like 'this', even in this case where it shouldn't be an issue, so we need to temporarily bind it to a variable */
                        /** Create the delay timer */
                        timers[this.timerId] = setTimeout('removeHover("", '+localTimer+')', delay);
                        this.hasTimer = true;
                    } else {
                        /** If no timer is needed, run removeHover immediately */
                        removeHover(this);
                        this.hasTimer = false;
                    }
                } /** /mouseout function */
                
                
            }  /** /dropdown menu */
            
            
            /** Expanding menu
             *  Which is the complicated one? ;)
             */
            else if (ulEls[i].className.indexOf("clickNav") >= 0) { /**If menu is click-deployed style */
                if(sfEls[i][ii].className.indexOf('bgIFrameCont') < 0) {
                    sfEls[i][ii].getElementsByTagName('A')[0].onclick = function() {
                        /**When the A within the menu LI is clicked, toggle expansion of parent LI */
                        if (this.parentNode.className.indexOf("sfhide") >= 0) {
                                        this.parentNode.className = this.parentNode.className.replace(new RegExp("sfhide\\b"), "");
                        } else {
                            this.parentNode.className += " sfhide";
                        }
                    }
                }
            } /** /expanding menu */            
        }
    }
} /** /sfHover function*/

womAdd('sfHover()');
