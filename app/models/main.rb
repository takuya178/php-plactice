class Main < ApplicationRecord
  has_many :food_combinations, dependent: :destroy
  has_many :subs, through: :food_combinations
  has_one_attached :image
  accepts_nested_attributes_for :subs, allow_destroy: true

  validates :name, presence: true
  validates :calorie, presence: true
  validates :sugar, presence: true
  validates :lipid, presence: true
  validates :salt, presence: true

  enum genre: { noodle: 0, rice: 1, bread: 2, candy: 3 }
end
