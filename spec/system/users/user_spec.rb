require 'rails_helper'

RSpec.describe 'ユーザー登録' do
  let(:user) { create(:user) }

  describe 'ログイン前' do
    context '入力情報（正常の場合）' do
      it 'ユーザーが新規作成できること' do
        visit '/users/new'
        expect {
          fill_in '名前', with: '田中太郎'
          fill_in 'メールアドレス', with: 'test@example.com'
          fill_in 'パスワード', with: '1234567' 
          fill_in 'パスワード確認', with: '1234567'
          click_button '登録'
      }.to change(User, :count).by(1)
      expect(page).to have_content('ユーザー登録が完了しました'), 'フラッシュメッセージ「ユーザー登録が完了しました」が表示されていません'
      end
    end

    context '各項目が未入力の場合' do
      it 'ユーザー登録に失敗する' do
        visit '/users/new'
        fill_in '名前', with: ''
        fill_in 'メールアドレス', with: ''
        fill_in 'パスワード', with: ''
        fill_in 'パスワード確認', with: ''
        click_button '登録'
        expect(page).to have_content '名前を入力してください'
        expect(page).to have_content 'メールアドレスを入力してください'
        expect(page).to have_content 'パスワードは3文字以上で入力してください'
        expect(page).to have_content 'パスワードは3文字以上で入力してください'
        expect(current_path).to eq users_path
      end
    end

    context 'メールアドレスが重複している場合' do
      it 'ユーザー登録に失敗する' do
        visit '/users/new'
        other_user = create(:user)
        fill_in "名前", with: "田中太郎"
        fill_in "メールアドレス", with: other_user.email
        fill_in "パスワード", with: "1234567" 
        fill_in "パスワード確認", with: "1234567"
        click_button '登録'
        expect(page).to have_content 'ユーザー登録に失敗しました'
        expect(page).to have_content 'メールアドレスはすでに存在します'
        expect(current_path).to eq users_path
      end
    end

    context 'パスワード確認が一致しない場合' do
      it 'ユーザー登録に失敗する' do
        visit '/users/new'
        fill_in "名前", with: "田中太郎"
        fill_in 'メールアドレス', with: 'test@example.com'
        fill_in "パスワード", with: "1234567" 
        fill_in "パスワード確認", with: "wrong-password"
        click_button '登録'
        expect(page).to have_content 'ユーザー登録に失敗しました'
        expect(page).to have_content 'パスワード確認とパスワードの入力が一致しません'
        expect(current_path).to eq users_path
      end
    end

    context 'パスワードが3文字未満の場合' do
      it 'ユーザー登録に失敗する' do
        visit '/users/new'
        fill_in "名前", with: "田中太郎"
        fill_in 'メールアドレス', with: 'test@example.com'
        fill_in "パスワード", with: 'p' * 2 
        fill_in "パスワード確認", with: 'p' * 2
        click_button '登録'
        expect(page).to have_content 'ユーザー登録に失敗しました'
        expect(page).to have_content 'パスワードは3文字以上で入力してください'
        expect(current_path).to eq users_path
      end
    end
  end  
end