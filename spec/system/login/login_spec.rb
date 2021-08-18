require 'rails_helper'

RSpec.describe 'ログイン・ログアウト' do
  let(:user) { create(:user) }

  describe '通常画面' do
    describe 'ログイン' do
      context '認証情報が正しい場合' do
        it 'ログインできること' do
          visit '/login'
          fill_in 'メールアドレス', with: user.email
          fill_in 'パスワード', with: user.password
          click_button 'ログイン'
          expect(current_path).to eq "/login"
        end
      end
    end
  end
end