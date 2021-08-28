class Sub < ApplicationRecord
  has_many :food_intermediates
  has_many :subs, through: :noodle_intermediates
end
