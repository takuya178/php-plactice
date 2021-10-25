class ChangeColumnToMain < ActiveRecord::Migration[6.0]
  def change
    change_column_null :mains, :calorie, false
    change_column_null :mains, :sugar, false
    change_column_null :mains, :lipid, false
    change_column_null :mains, :salt, false
  end
end
