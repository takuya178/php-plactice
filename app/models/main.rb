class Main < ApplicationRecord
  has_many :food_combinations, dependent: :destroy
  has_many :subs, through: :food_combinations

  has_one_attached :image

  enum genre: { noodle: 0, rice: 1, bread: 2, candy: 3 }
end
