class Sub < ApplicationRecord
  has_many :food_combinations
  has_many :mains, through: :food_combinations
  has_one_attached :image
end
