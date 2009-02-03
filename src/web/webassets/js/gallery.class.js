<!--


/* -----------------------------------------------------
 photo gallery
 ----------------------------------------------------- */

var galleryObj;

function gallery ()
{
    this.init =       init;
    this.next =       next;
    this.prev =       prev;
    this.close =      close;
	this.toggleLoad = toggleLoad;
	this.load =       load;
	this.setInfo =    setInfo;
	this.alignImage = alignImage;
    this.pauseAWhile = pauseAWhile;

	this.galleryObjects = "";

    this.bg = $('photoGalleryBG');
    this.contentDiv = $('photoGalleryContent');
    this.imageDiv = $('photoGalleryImage');
    this.captionDiv = $('photoGalleryCaption');
    this.creditDiv = $('photoGalleryCredit');

    document.getElementsByTagName('body')[0].id = 'bodyTag';
    this.bodyDim = $('bodyTag').getDimensions();

    this.currentImg=0;


    function toggleLoad()
    {
        var vis = $('photoGalleryLoading').getStyle('visibility');
        (vis == 'visible') ? $('photoGalleryLoading').setStyle({visibility: 'hidden'}) : $('photoGalleryLoading').setStyle({visibility: 'visible'})
		$('photoGalleryNav').setStyle({visibility:'visible'});
    }


    function load(photos)
    {
		this.galleryObjects = photos;
		this.numImages = this.galleryObjects.length-1;
		this.toggleLoad();
		//center nav, photo, caption, credit
        $('photoGalleryContent').setStyle({margin:0});
        $('photoGalleryContent').setStyle({marginLeft:(this.bodyDim.width/2) - ($('photoGalleryContent').getWidth()/2) + 'px'});
   		this.next();
    }

    function init()
    {

		$('photoGalleryBG').setStyle({height:this.bodyDim.height+'px', width:this.bodyDim.width+'px'});

       //show the gallery
		new Effect.Appear( $('photoGallery') )

    };


    function next ()
    {
        this.toggleLoad();
        this.imageDiv.setStyle({visibility: 'hidden'})
        this.pauseAWhile(200);
        $('photoGalleryImage').update(this.galleryObjects[this.currentImg].img);
//        this.pauseAWhile(500);
        this.alignImage();
        this.imageDiv.setStyle({visibility: 'visible'});
        this.setInfo();
        this.toggleLoad();

		this.currentImg++;
		if (this.currentImg > this.numImages)
			this.currentImg = 0;
    };


    function prev()
    {
        this.toggleLoad();
        $('photoGalleryImage').setStyle({visibility: 'hidden'})
        this.imageDiv.update(this.galleryObjects[this.currentImg].img);
        this.pauseAWhile(1000);
        this.alignImage();
        this.imageDiv.setStyle({visibility: 'visible'})
        this.setInfo();
        this.toggleLoad();

        this.currentImg--;

		if (this.currentImg < 0)
			this.currentImg = this.numImages;
    };

		function alignImage()
		{
        Element.setStyle(this.imageDiv.firstChild, {paddingTop:'0px'});
				this.imageDiv.firstChild.setStyle({paddingTop:this.imageDiv.getHeight()-this.imageDiv.firstChild.getHeight()+'px' });
		};

    function setInfo()
    {
		this.captionDiv.update();
        this.creditDiv.update();

        if (this.galleryObjects[this.currentImg].caption != '')
	  	    this.captionDiv.update(this.galleryObjects[this.currentImg].caption);

        if (this.galleryObjects[this.currentImg].credit != '')
        {
          //var creditStaticText = this.creditDiv.innerHTML.split('&nbsp;');
          //this.creditDiv.update();
          //this.creditDiv.update(creditStaticText[0]+'&nbsp;'+this.galleryObjects[this.currentImg].credit);
          this.creditDiv.update(this.galleryObjects[this.currentImg].credit);
        }
        else
        {
          this.creditDiv.update();
        }

	      this.creditDiv.focus();

    };


    function close()
    {
		this.currentImg = 0;
		this.imageDiv.update();
		this.creditDiv.update();
		this.captionDiv.update();
        this.toggleLoad();
        new Effect.Fade( $('photoGallery') )
    }


    function pauseAWhile(ms)
    {
      var date = new Date();
      var curDate = null;

      do { curDate = new Date(); }
      while(curDate-date < ms);
    }
}









//-->