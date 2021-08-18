require 'rails_helper'

RSpec.describe 'ユーザー登録' do

  context '入力情報（正常の場合）' do
    it 'ユーザーが新規作成できること' do
      visit '/users/new'
      expect {
        fill_in "名前", with: "田中太郎"
        fill_in "メールアドレス", with: "test@example.com"
        fill_in "パスワード", with: "1234567" 
        fill_in "パスワード確認", with: "1234567"
        click_button "登録"
    }.to change(User, :count).by(1)
    end
  end

  # context '入力情報（異常の場合）' do
  #   it 'ユーザーが新規作成でエラー発生' do
  #     expect {
  #       fill_in "メールアドレス", with: "test@example.com"
  #       click_button "登録"
  #   }.to change(User, :count).by(0)
  #   end
  # end
end