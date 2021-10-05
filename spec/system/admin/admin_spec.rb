require 'rails_helper'

RSpec.describe "Admins", type: :system do
  let(:general) { create :user }
  let(:admin) { create :user, :admin }
  
  describe '管理画面へアクセス' do
    context '一般ユーザーがアクセス' do
      context 'ログイン前' do
        it '管理画面へのアクセスができない' do
          general
          visit admin_root_path
          expect(current_path).to eq admin_login_path
          expect(page).to have_content 'ログインしてください'
        end
      end
    end
  end
end