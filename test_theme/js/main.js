jQuery(document).ready(function($) {
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 30,

        slidesOffsetBefore: -15, // Відступ перед слайдом
        slidesOffsetAfter: -15, // Відступ після слайду

        loop: true,
        // autoplay: {
        //     delay: 5000, // 5 seconds delay for each slide
        //     disableOnInteraction: false, // Continue autoplay on swipe
        // },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        on: {
            init: function() {
                var swiperInstance = this;
                $('.swiper-container').hover(
                    function() { swiperInstance.autoplay.stop(); },
                    function() { swiperInstance.autoplay.start(); }
                );
            },
        },
        breakpoints: {
            1024: {

                slidesPerView: 4,
                spaceBetween: 30
            },
            768: {
                centeredSlides: false,
                slidesPerView: 3,
                spaceBetween: 20
            },
            640: {

                slidesPerView: 3,
                spaceBetween: 10,

            },
            350: {

                slidesPerView: 2,
                spaceBetween: 5
            },
            1: {
                watchOverflow: true,
                centeredSlides: true,
                slidesPerView: 2,
                spaceBetween: 15
            }

        }
    });

    // swiper slide click
    $('.swiper-slide').on('click', function() {
        var postID = $(this).data('post-id');

        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: 'POST',
            data: {
                action: 'load_post_content',
                post_id: postID,
                //security: 'value_of_nonce', // if using nonce
            },
            success: function(response) {
                if (response.success) {
                    $.magnificPopup.open({
                        items: {
                            src: '<div class="custom-popup">' +
                                '<h4>Description</h4><hr>' +
                                '<div class="custom-popup__text">' + response.data.content + '</div>' +
                                '</div>',
                            type: 'inline'
                        }
                    });
                } else {
                    console.error('Error: ', response);
                }
            },
            error: function(error) {
                console.error('AJAX error: ', error);
            }
        });
    });
});