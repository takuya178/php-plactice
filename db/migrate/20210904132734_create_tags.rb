class CreateTags < ActiveRecord::Migration[6.0]
  def change
    create_table :tags do |t|
      t.string :component
      t.string :genre

      t.timestamps
    end
  end
end
