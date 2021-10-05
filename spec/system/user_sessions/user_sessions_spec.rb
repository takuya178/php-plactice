require 'rails_helper'

RSpec.describe 'ログイン・ログアウト' do
    describe 'ログイン' do
      let(:user) { create(:user) }
      context '認証情報が正しい場合' do
        it 'ログインできること' do
          visit '/login'
          fill_in 'メールアドレス', with: user.email
          fill_in 'パスワード', with: 'password'
          click_button 'ログイン'
          expect(current_path).to eq select_food_combinations_path
          expect(page).to have_content('ログインしました'), 'フラッシュメッセージ「ログインしました」が表示されていません'
        end
      end

      context 'パスワードに誤りがある場合' do
        it 'ログインできないこと' do
          visit '/login'
          fill_in 'パスワード', with: '123'
          click_button 'ログイン'
          expect(current_path).to eq '/login'
          expect(page).to have_content('ログインに失敗しました'), 'フラッシュメッセージ「ログインに失敗しました」が表示されていません'
        end
      end
    end
end