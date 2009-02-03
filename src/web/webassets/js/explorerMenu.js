<!--
/*************************************************************
 * explorerMenu()
 *
 * Finds all uls of class 'explorerMenu', and makes an explorer-like navigation system
 * Relies on webassets/css/explorerMenu.css
 * Include bootstrap and this file, and all ul's will be converted.
 *************************************************************/
var explorerMenuOptions;

function explorerMenu()
{
    //set some defaults
    if (empty(explorerMenuOptions) || typeof explorerMenuOptions == 'undefined')
    {
        explorerMenuOptions = {expandedTitleText: 'collapse', collapsedTitleText: 'expand'};
    }

    var ulObjs = getElementsByClassName("explorerMenu", "UL");

    for (i=0; i<ulObjs.length; i++)
    {
        var ulObj = ulObjs[i];

        //var liObjs = new Array();
        var liObjs = ulObj.getElementsByTagName("LI");

        for (var ii=0; ii<liObjs.length; ii++)
        {
            var liObj = liObjs[ii];

            //do only if the li has children
            if (liObj.className.indexOf('daddy') != -1)
            {
                var expandButtonObj = findFirstElementByClassName({startAt: liObj, cssClass: 'expandButton', deep: true});
                if (!expandButtonObj) continue;
                else expandButtonObj = expandButtonObj.getElementsByTagName('A')[0];
                expandButtonObj.onclick = function()
                {
                    //find the parent (li)
                    var parent = findFirstElementByNodeName({nodeNameToFind: 'li', startAt: this, direction: 'back'});
                    if (!parent) return;

                    //When the A within the menu LI is clicked, toggle expansion of parent LI - 2 levels above the <a> (<a> is contained in a <span>, which is contained in the <li>
                    if (parent.className.indexOf("expanded") >= 0)
                    {
                                    //set the className of the a for image switching
                                    this.className = this.className.replace(new RegExp("expanded\\b"), "")

                                    this.title = explorerMenuOptions.collapsedTitleText;
                                    //set the className of the parent LI
                                    parent.className = parent.className.replace(new RegExp("expanded\\b"), "");

                                    //replace the '-' text in the child span of this
                                    this.firstChild.innerHTML = '+';
                    }
                    else
                    {
                        //set the className of the a for image switching
                        this.className += " expanded";

                        this.title = explorerMenuOptions.expandedTitleText;

                        //set the className of the parent LI
                        parent.className += " expanded";

                        //set the html text of the child span to '-'
                        this.firstChild.innerHTML = '-';
                    }
                }//onclick def

                continue;

            }//if className == 'daddy'
        }//for ii

        }//for i

} //explorerMenu


womAdd('explorerMenu()');

//-->


