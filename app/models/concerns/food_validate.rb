module FoodValidate
  extend ActiveSupport::Concern

  included do
    validates :name, presence: true
    validates :calorie, presence: true
    validates :sugar, presence: true
    validates :lipid, presence: true
    validates :salt, presence: true
  end
end