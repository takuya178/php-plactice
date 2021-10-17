require 'rails_helper'

RSpec.describe Inquiry, type: :model do
  it "カテゴリー、メッセージがある場合有効" do
    inquiry = build(:inquiry)
    expect(inquiry).to be_valid
  end
  
  it "メッセージがない場合無効" do
    inquiry = build(:inquiry, message: nil)
    inquiry.valid?
    expect(inquiry.errors[:message]).to include("を入力してください") 
  end

  it "メッセージが3001字以上、無効" do
    inquiry = build(:inquiry, message: "a" * 3001)
    inquiry.valid?
    expect(inquiry.errors[:message]).to include("は3000文字以内で入力してください") 
  end
end
