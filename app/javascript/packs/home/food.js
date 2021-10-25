(() => {
  const tab = document.getElementById('tab')
  const normal = document.getElementById('js-normalselect');
  const abnormal = document.getElementById('js-ngselect');
  const normalbtn = document.getElementById('js-normalbtn');
  const ngbtn = document.getElementById('js-ngbtn');
  const contents = document.querySelectorAll('#js-contents');
  const table = document.getElementById('food_table');
  console.log(table)
  const ngfood = document.getElementById('js-ngfood');
  const scroll = document.getElementById( 'js-scroll-fadein' );


  ngfood.addEventListener('click', () => {
    location.href = '/overdose_food_combinations' + location.search
  });

  // スクロールトップ

  //スクロール量を取得する関数
  const getScrolled = () => {
    let ref;
    if(window.pageYOffset !== undefined) {
      ref = window.pageYOffset;
    }else {
      ref = document.documentElement.scrollTop;
    }
    return ref;
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
})();
