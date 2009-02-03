
Effect.Center = function(element)
{
    try
    {
        element = $(element);
    }
    catch(e)
    {
        return;
    }

    var my_width  = 0;
    var my_height = 0;

    if ( typeof( window.innerWidth ) == 'number' )
    {

        my_width  = window.innerWidth;
        my_height = window.innerHeight;
    }
    else if ( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) )
    {

        my_width  = document.documentElement.clientWidth;
        my_height = document.documentElement.clientHeight;
    }
    else if ( document.body && ( document.body.clientWidth || document.body.clientHeight ) )
    {

        my_width  = document.body.clientWidth;
        my_height = document.body.clientHeight;
    }

    element.style.position = 'absolute';
    //element.style.display  = 'block';
    element.style.zIndex   = 99;

    var scrollY = 0;

    if ( document.documentElement && document.documentElement.scrollTop )
    {
        scrollY = document.documentElement.scrollTop;
    }
    else if ( document.body && document.body.scrollTop )
    {
        scrollY = document.body.scrollTop;
    }
    else if ( window.pageYOffset )
    {
        scrollY = window.pageYOffset;
    }
    else if ( window.scrollY )
    {
        scrollY = window.scrollY;
    }

    var elementDimensions = Element.getDimensions(element);

    var setX = ( my_width  - elementDimensions.width  ) / 2;
    var setY = ( my_height - elementDimensions.height ) / 2 + scrollY;

    setX = ( setX < 0 ) ? 0 : setX;
    setY = ( setY < 0 ) ? 0 : setY;

    element.style.left = setX + "px";
    element.style.top  = setY + "px";

};


Effect.SlideRightIntoView = function(element) {
  $(element).style.width = '0px';
  $(element).style.overflow = 'hidden';
  $(element).firstChild.style.position = 'relative';
  Element.show(element);
  new Effect.Scale(element, 100,
    Object.extend(arguments[1] || {}, {
      scaleContent: false,
      scaleY: false,
      scaleMode: 'contents',
      scaleFrom: 0,
      afterUpdate: function(effect){}
    })
  );
};

Effect.SlideRightOutOfView = function(element) {
  $(element).style.overflow = 'hidden';
  $(element).firstChild.style.position = 'relative';
  Element.show(element);
  new Effect.Scale(element, 0,
    Object.extend(arguments[1] || {}, {
      scaleContent: false,
      scaleY: false,
      afterUpdate: function(effect){},
      afterFinish: function(effect)
        { Element.hide(effect.element); }
    })
  );
};

Effect.SlideLeftAndRight = function(element) {
  element = $(element);
  if(Element.visible(element)) new Effect.SlideRightOutOfView(element);
  else new Effect.SlideRightIntoView(element);
};

Effect.PhaseIn = function(element) {
  element = $(element);
  new Effect.BlindDown(element, arguments[1] || {});
  new Effect.Appear(element, arguments[2] || arguments[1] || {});
};

Effect.PhaseOut = function(element) {
  element = $(element);
  new Effect.Fade(element, arguments[1] || {});
  new Effect.BlindUp(element, arguments[2] || arguments[1] || {});
};

Effect.Phase = function(element) {
  element = $(element);
  if (element.style.display == 'none')
    new Effect.PhaseIn(element, arguments[1] || {}, arguments[2] || arguments[1] || {});
  else new Effect.PhaseOut(element, arguments[1] || {}, arguments[2] || arguments[1] || {});
};




Effect.PopOut = function(element) {
  element = $(element);
  var oldTop = element.style.top;
  var oldLeft = element.style.left;
  var pos = Position.cumulativeOffset(element);
   return new Effect.Parallel(
    [ new Effect.MoveBy(element, -100, 0, { sync: true }),
      new Effect.Opacity(element, { sync: true, from:1, to: 0 }) ],
    Object.extend(
      { duration: 0.5,
        beforeSetup: function(effect) {
          Element.makePositioned(effect.effects[0].element);
          Element.setOpacity(element, 1);
          element.style.position = 'absolute';
         // element.style.top = (pos[1]-100) + 'px';
        }
      }, arguments[1] || {}));
};

//transitions
Effect.Transitions.slowstop = function(pos) {
  return 1-Math.pow(0.5,20*pos);
};

Effect.Transitions.exponential = function(pos) {
  return 1-Math.pow(1-pos,2);
};

Effect.FadeOutAndLeft = function(element) {
  element = $(element);
  var oldTop = element.style.top;
  var oldLeft = element.style.left;
  var pos = Position.cumulativeOffset(element);
   return new Effect.Parallel(
    [ new Effect.MoveBy(element, 0, -50, { sync: true }),
      new Effect.Opacity(element, { sync: true, from:1, to: 0 }) ],
    Object.extend(
      { duration: 0.5,
        beforeSetup: function(effect) {
          Element.makePositioned(effect.effects[0].element);
          Element.setOpacity(element, 1);
          element.style.position = 'absolute';
         // element.style.top = (pos[1]-100) + 'px';
        }
      }, arguments[1] || {}));
};






Effect.SlideLeft = function(element) {
  element = $(element);
  element.cleanWhitespace();
  var oldInnerRight = $(element.firstChild).getStyle('right');
  return new Effect.Scale(element, window.opera ? 0 : 1,
   Object.extend({ scaleContent: false,
    scaleY: false,
    scaleMode: 'box',
    scaleFrom: 100,
    restoreAfterFinish: true,
    beforeStartInternal: function(effect) {
      effect.element.makePositioned();
      effect.element.firstChild.makePositioned();
      if(window.opera) effect.element.setStyle({left: ''});
      effect.element.makeClipping();
      effect.element.show(); },
    afterUpdateInternal: function(effect) {
      effect.element.firstChild.setStyle({right:
        (effect.dims[0] - effect.element.clientWidth) + 'px' }); },
    afterFinishInternal: function(effect) {
      effect.element.hide();
      effect.element.undoClipping();
      effect.element.firstChild.undoPositioned();
      effect.element.undoPositioned();
      effect.element.setStyle({right: oldInnerRight}); }
   }, arguments[1] || {})
  );
};



Effect.SlideRight = function(element) {
  element = $(element);
  Element.cleanWhitespace(element);
  var oldInnerRight = Element.getStyle(element.firstChild, 'right');
  return new Effect.Scale(element, 100,
   Object.extend({ scaleContent: false,
    scaleY: false,
    scaleMode: 'box',
    scaleFrom: 0,
    restoreAfterFinish: true,
    beforeStartInternal: function(effect) { with(Element) {
      makePositioned(effect.element);
      makePositioned(effect.element.firstChild);
      if(window.opera) setStyle(effect.element, {top: ''});
      makeClipping(effect.element);
      show(element); }},
    afterUpdateInternal: function(effect) { with(Element) {
      setStyle(effect.element.firstChild, {right:
        (effect.dims[0] - effect.element.clientWidth) + 'px' }); }},
    afterFinishInternal: function(effect) { with(Element) {
        [undoClipping].call(effect.element);
        undoPositioned(effect.element.firstChild);
        undoPositioned(effect.element);
        setStyle(effect.element.firstChild, {right: oldInnerRight}); }}
   }, arguments[1] || {})
  );
}




Element.addMethods();

