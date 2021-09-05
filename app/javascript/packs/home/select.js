

  const $tab = document.getElementById('tab')
  const $link = $tab.querySelectorAll('a')
  const $img = $tab.querySelectorAll('img')
  const $text = $tab.querySelectorAll('h2')
  const $check = $tab.querySelectorAll('h1')

  const sugarId = [];
  const lipidId = [];
  const saltId = [];

  const button = document.querySelector('#js-button');

  const handleClick = (e) => {
    e.preventDefault();
  }


  // 糖質部分がクリックされた処理
  $link[0].addEventListener('click', (e) => {
    handleClick(e)
    if($text[0].style.display == 'block') {
      $text[0].style.display = 'none'
      $check[0].style.display = 'block'
      sugarId.push($link[0].dataset.id)
    } else {
      $text[0].style.display = 'block'
      $check[0].style.display = 'none'
      sugarId.pop($link[0].dataset.id)
    }
    console.log(sugarId)
    $img[0].classList.toggle('filter');
  });

  // 脂質部分がクリックされた処理
  $link[1].addEventListener('click', (e) => {
    handleClick(e)
    if($text[1].style.display == 'block') {
      $text[1].style.display = 'none'
      $check[1].style.display = 'block'
      lipidId.push($link[1].dataset.id)
    } else {
      $text[1].style.display = 'block'
      $check[1].style.display = 'none'
      lipidId.pop($link[1].dataset.id)
    }
    $img[1].classList.toggle('filter');
  });

  // 塩分がクリックされた処理
  $link[2].addEventListener('click', (e) => {
    handleClick(e)
    if($text[2].style.display == 'block') {
      $text[2].style.display = 'none'
      $check[2].style.display = 'block'
      saltId.push($link[2].dataset.id)
    } else {
      $text[2].style.display = 'block'
      $check[2].style.display = 'none'
      saltId.pop($link[2].dataset.id)
    }
    $img[2].classList.toggle('filter');
  });

  // ボタンを押して/resultページへ
  button.addEventListener('click', () => {
    $.ajax({
      type: 'get',
      url: '/foods/result',
      data: {
        sugar: sugarId,
        lipid: lipidId,
        salt: saltId, 
      }
    }).done(() => {
      window.location.href = '/foods/result?sugar%5B%5D=' + sugarId + '&lipid%5B%5D=' + lipidId + '&salt%5B%5D=' + saltId;
    });
  });