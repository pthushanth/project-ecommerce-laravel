function showGlider(selecteurID){
    // console.log(selecteur);

    selecteur=selecteurID+' .glider';
    console.log(selecteur);
    document.querySelector(selecteur).addEventListener('glider-slide-visible', function(event){
        var glider = Glider(this);
        // console.log('Slide Visible %s', event.detail.slide)
    });
    document.querySelector(selecteur).addEventListener('glider-slide-hidden', function(event){
        // console.log('Slide Hidden %s', event.detail.slide)
    });
    document.querySelector(selecteur).addEventListener('glider-refresh', function(event){
        // console.log('Refresh')
    });
    document.querySelector(selecteur).addEventListener('glider-loaded', function(event){
        // console.log('Loaded')
    });

    window._ = new Glider(document.querySelector(selecteur), {
        slidesToShow: 3, //'auto',
        slidesToScroll: 1,
        itemWidth: 150,
        draggable: true,
        scrollLock: true,
        dots: '#dots',
        rewind: true,
        duration: 1.2,
        arrows: {
            prev: selecteurID+' .glider-prev',
            next: selecteurID+' .glider-next'
        },
        easing: function (x, t, b, c, d) {
      return c*(t/=d)*t + b;
    },
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToScroll: 1,
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToScroll: 2,
                    slidesToShow: 2,
                    dots: false,
                    arrows: false,
                    scrollLock: true
                }
            }
        ]
    });
  }