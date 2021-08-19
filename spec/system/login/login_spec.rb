require 'rails_helper'

RSpec.describe 'ログイン・ログアウト' do
  let(:user) { create(:user) }

  describe '通常画面' do
    describe 'ログイン' do
      context '認証情報が正しい場合' do
        it 'ログインできること' do
          visit '/login'
          fill_in 'メールアドレス', with: user.email
          fill_in 'パスワード', with: '1234567'
          click_button 'ログイン'
          expect(current_path).to eq '/'
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
end