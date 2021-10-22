const normalbtn = document.getElementById('js-normalbtn');
const scroll = document.getElementById( 'js-scroll-fadein' );

normalbtn.addEventListener('click', () => {
  ref = document.referrer
  location.href = ref;
});

  // スクロールトップ

  //スクロール量を取得する関数
  const getScrolled = () => {
    let index;
    if(window.pageYOffset !== undefined) {
      index = window.pageYOffset;
    }else {
      index = document.documentElement.scrollTop;
    }
    return index;
  };
  //ボタンの表示・非表示
  window.onscroll = () => {
    if(getScrolled() > 500) {
      scroll.classList.add( 'is-fadein' )
    }else {
      scroll.classList.remove( 'is-fadein' );
    }
  };
  // トップに移動する
  const scrollTop = () => {
    window.scrollTo( 0, 0 );
  }
  // スクロールボタンをクリックできるようにする
  scroll.addEventListener('click', () => {
    scrollTop();
  })