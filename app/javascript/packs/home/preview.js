(() => {
  class Preview {
    constructor(obj) {
      const $file = document.getElementById(obj.hookId);
      this.$image = document.getElementById(obj.hookImg);
      this.$NoImage = document.getElementById(obj.hookNoImg);

      $file.addEventListener('change', (e) => {
        this.previewImg(e);
      });
    }
    previewImg(e) {
      // // no-imgをdisplay:noneにする
        this.$NoImage.style.display = 'none';

      // 添付した画像にクラスやデータを付与
      const createImage = (data) => {
        // const $image = document.getElementById('js-main-image');
        const newImage = document.createElement('img'); 
        newImage.setAttribute('class', 'food_create_preview_img');
        newImage.setAttribute('src', data);
        this.$image.appendChild(newImage);
      };

      // 続けて画像を添付する時、前回の画像を削除する
      const imageItem = this.$image.querySelector('img')
      if (imageItem){
        imageItem.remove();
      }
  
      // 取得した画像データを$ImgFileに代入
      const $ImgFile = e.target.files[0];
      const data = window.URL.createObjectURL($ImgFile);
      createImage(data);
    }
  }

  // メインのプレビュー
  const MainPreview = new Preview({
    hookId: 'main_image',
    hookImg: 'js-main-image',
    hookNoImg: 'js-main-no-img'
  })

  // サブのプレビュー
  const SubPreview = new Preview({
    hookId: 'main_subs_attributes_0_image',
    hookImg: 'js-sub-image',
    hookNoImg: 'js-sub-no-img'
  })

})();