class CreateSubs < ActiveRecord::Migration[6.0]
  def change
    create_table :subs do |t|
      t.string :name, null: false
      t.string :image
      t.integer :calorie, null: false
      t.float :sugar, null: false
      t.float :lipid, null: false
      t.float :salt, null: false

      t.timestamps
    end
  end
end
