class Sub < ApplicationRecord
  has_many :food_combinations, dependent: :destroy
  has_many :mains, through: :food_combinations
  has_one_attached :image
end
