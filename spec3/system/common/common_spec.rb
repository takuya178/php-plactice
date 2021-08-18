require 'rails_helper'

RSpec.describe '共通系', type: :system do
  before do
    visit root_path
  end
  describe 'ヘッダー' do
    it 'ヘッダーが正しく表示されていません' do
      expect(page).to have_content('掲示板'), 'ヘッダーに「掲示板」というテキストが表示されていません'
    end
  end

  describe 'フッター' do
    it 'フッターが正しく表示されていること' do
      expect(page).to have_content('2021. health_conve'), '「2021. health_conve」というテキストが表示されていません'
    end
  end
end