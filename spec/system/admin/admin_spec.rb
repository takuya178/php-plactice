require 'rails_helper'

RSpec.describe "Admins", type: :system do
  let(:general) { create :user }
  let(:admin) { create :user, :admin }
  
  describe '管理画面へのアクセス' do
    context '一般ユーザーの場合' do
      context 'ログイン前' do
        it '管理画面へのアクセスが失敗する' do
          general
          visit admin_root_path
          expect(current_path).to eq admin_login_path
          expect(page).to have_content 'ログインしてください'
        end
      end
    end
    context 'ログイン後' do
      it '管理画面へのアクセスが成功する' do
        login(admin)
        visit admin_root_path
      end
    end
  end
end