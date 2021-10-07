class FoodCombination < ApplicationRecord
  belongs_to :main
  belongs_to :sub

  enum stores: { seven: 0, lawson: 1 }

  def get_sugar
    { 'value': main.sugar + sub.sugar }
  end

  def get_lipid
    { 'value': main.lipid + sub.lipid }
  end

  def get_salt
    { "value": main.salt + sub.salt }
  end

end
