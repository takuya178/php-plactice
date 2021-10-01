class Main < ApplicationRecord
  has_many :food_combinations
  has_many :subs, through: :food_combinations

  has_one_attached :main

  enum genre: { noodle: 0, rice: 1, bread: 2, candy: 3 }
end
