require 'rails_helper'

RSpec.describe User, type: :model do
  it '姓、名、メールがあり、パスワードは3文字以上であれば有効であること' do
    user = build(:user)
    expect(user).to be_valid
  end
end