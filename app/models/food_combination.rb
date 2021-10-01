class FoodCombination < ApplicationRecord
  belongs_to :main
  belongs_to :sub

  enum stores: { seven: 0, lawson: 1 }
end
